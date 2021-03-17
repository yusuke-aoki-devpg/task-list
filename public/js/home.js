//create circles array
let circles = [];
let clicked = false;
let clickedX;
let clickedY;

//get date only
function formatDate(d){  
    var month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}

//get time
function formatTime(d){  
    var minutes = '' + d.getMinutes(),
        secounds = '' + d.getSeconds(),
        hours = d.getHours();

    if (minutes.length < 2) 
        minutes = '0' + minutes;
    if (secounds.length < 2) 
        secounds = '0' + secounds;

    return [hours, minutes, secounds].join(':');
}

function setup(){
    let cnv = createCanvas(windowWidth, windowHeight-120);
    cnv.position(0, 120);
    cnv.parent("canvasContainer");
    cnv.id('canvas');
    

    let protection = 0;

    for(var i = 0; i < taskObj.length; i++){ 
        let taskdate = formatDate(new Date(taskObj[i].deadline));    
        let tasktime = formatTime(new Date(taskObj[i].deadline));
        
        console.log("taskdate", taskdate);
        console.log("tasktime", tasktime);

        let circle = {
            x: random(70, width - 70),
            y: random(70, height - 70),
            r: taskdate === dtoday ? 
                    65 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        48 : 28,
            circleColor: taskdate === dtoday ? 
                color(240,119,110) : taskdate > dtoday && taskdate <= d3DaysLater ? 
                    color(255,242,105) : color(170,250,170),
            textColor: taskdate === dtoday ? 
                "#FFF" : taskdate > dtoday && taskdate <= d3DaysLater ? 
                    "#000" : "#000",
            textsize: taskdate === dtoday ? 
                    18 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        12 : 8,
            textsizesmall: taskdate === dtoday ? 
            12 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                10 : 6,
    
            textspace: taskdate === dtoday ? 
                    18 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        12 : 10,
            title: taskObj[i].todo,
            date: taskdate,
            time: tasktime,
            id: taskObj[i].id
        }
        
        //check overlap
        var overlapping = false;
        for(var j = 0; j < circles.length; j++){
            var other = circles[j];
            var d = dist(circle.x, circle.y, other.x, other.y);
            if(d < circle.r + other.r){
                overlapping = true;
            }               
        }

        //if overlap, return to the number before
        if(overlapping){
            i--;
        }

        //if not overlap, push into circles array
        if(!overlapping){
            circles.push(circle);
        }

        //limit for retry, prevent unfinish checking
        protection++;
        if(protection > 10000){
            console.log(i);
            break;
        }
    }         
}

//draw circles
function draw(){
    background(250,250,250,100);

    circles.forEach(function(cir){
        //draw circle
        fill(cir.circleColor);
        stroke(0, 0, 0, 50);
        strokeWeight(2);
        ellipse(cir.x, cir.y, cir.r*2, cir.r*2);            
        
        //draw text
        let line1 = `${cir.title}\n`;
        fill(cir.textColor);
        noStroke();
        textAlign(CENTER, CENTER);
        textSize(cir.textsize);
        textLeading(cir.space);
        text(line1, cir.x, cir.y);      
        
        let line2 = `\n\n\n${cir.date}\n${cir.time}`;
        textSize(cir.textsizesmall);
        text(line2, cir.x, cir.y);      

        var d = dist(cir.x, cir.y, mouseX, mouseY);
        //mouseOver(d, cir.r, cir.x, cir.y, cir.textsize, cir.space, lines);
    });
}

//clear circles array and redraw circles when resize window
function windowResized() {
    resizeCanvas(windowWidth, windowHeight-100);
    circles = [];
    document.getElementById('popup').style.cssText = 'display:none';
    setup();
}

//pass mouse x y to showMsg when click inside circles
function mouseClicked() {    
    circles.forEach(function(cir){
        var d = dist(cir.x, cir.y, mouseX, mouseY);
        if(d < cir.r){
            clickedX = mouseX + 30 + "px";
            clickedY = mouseY + 30 + "px";
            showMsg(cir.title, clickedX, clickedY, cir.id);
        }
    });
}

//show popup when click inside circles
function showMsg(data, left, top, id){
    document.getElementById('popup').style.cssText = 'display:block';
    document.getElementById('popup').innerHTML = `
        <div class="popuptext">
            <h4>${data}</h4>
        </div>        
        <div class="popuptext option">
            <div><a href="#">編集</a></div>　
            <div><a href="#">削除</a></div>
        </div>
    `;
    document.getElementById('popup').style.left = left;
    document.getElementById('popup').style.top = top;
}

//Hide popup when click anywhere outside popup div
document.body.addEventListener('click', function(e){
    document.getElementById('popup').style.cssText = 'display:none';
})

//nothing happen when click inside popup div
document.getElementById('popup').addEventListener('click', function(e){
    e.stopPropagation();
})  

