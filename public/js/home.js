//create circles array
let circles = [];
let clicked = false;
let clickedX;
let clickedY;
let drawNum;


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

function formatDateJP(d){  
    var month = '' + (d.getMonth() + 1),
        day = '' + d.getDate()

    return month + "月" + day + "日";
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

    return [hours, minutes].join(':');
}

function shortenStr(str){
    if(str.length >= 5){
        return str.substring(0, 5) + "...";
    }else {
        return str;
    }
}

function setup(){
    let cnv = createCanvas(windowWidth, windowHeight-120);
    cnv.position(0, 120);
    cnv.parent("canvasContainer");
    cnv.id('canvas');
    

    let protection = 0;

    for(var i = 0; i < taskObj.length; i++){ 
        let taskdate = formatDate(new Date(taskObj[i].deadline));   
        let taskdatejp = formatDateJP(new Date(taskObj[i].deadline)); 
        let tasktime = formatTime(new Date(taskObj[i].deadline));
        let newStr = shortenStr(taskObj[i].todo);

        let circle = {
            x: random(100, width - 100),
            y: random(100, height - 100),
            r: taskdate === dtoday ? 
                    80 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        65 : 48,
            circleColor: taskdate === dtoday ? 
                color(240,119,110) : taskdate > dtoday && taskdate <= d3DaysLater ? 
                    color(255,242,105) : color(170,250,170),
            textColor: taskdate === dtoday ? 
                "#FFF" : taskdate > dtoday && taskdate <= d3DaysLater ? 
                    "#000" : "#000",
            textsize: taskdate === dtoday ? 
                    24 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        18 : 12,
            textsizesmall: taskdate === dtoday ? 
            18 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                12 : 10,
    
            textspace: taskdate === dtoday ? 
                    18 : taskdate > dtoday && taskdate <= d3DaysLater ? 
                        12 : 10,
            title: newStr,
            date: taskdatejp,
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
            break;            
        }

    }         
}

//draw circles
function draw(){
    if(circles.length < taskObj.length){
        document.getElementById('msgContainer').innerText = "全てのタスク表示できません";
    }else {
        document.getElementById('msgContainer').innerText = "";

    }
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
    });
}

//clear circles array and redraw circles when resize window
function windowResized() {
    resizeCanvas(windowWidth, windowHeight-100);
    circles = [];
    document.querySelectorAll('.popup').forEach(function (popup){
        popup.style.display = 'none';
    });
    setup();
}

//pass mouse x y to showMsg when click inside circles
function mouseClicked() {    
    circles.forEach(function(cir){
        var d = dist(cir.x, cir.y, mouseX, mouseY);
        if(d < cir.r){
            clickedX = mouseX + "px";
            clickedY = mouseY + 70 + "px";
            showMsg(cir.title, clickedX, clickedY, cir.id);
        }
    });
}

//show popup when click inside circles
function showMsg(data, left, top, id){
    document.getElementById('popup'+id).style.display = 'initial';
    document.getElementById('popup'+id).style.left = left;
    document.getElementById('popup'+id).style.top = top;
}

//Hide popup when click anywhere outside popup div
document.body.addEventListener('click', function(){
    document.querySelectorAll('.popup').forEach(function (popup){
        popup.style.display = 'none';
    })
})


//nothing happen when click inside popup div
document.querySelectorAll('.popup').forEach(function (popup) {
    popup.addEventListener('click', function(e){
            e.stopPropagation();
        });  
});





