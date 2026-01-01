function goBack() 
{
    window.history.back();
}

function autoScroll() {
    window.scrollBy(0, 100); // Scroll down by 1 pixel
}

function sort()
{
    var status = document.getElementById("status").value;
    console.log(status);
    
    if(status != "")
    {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4)
                document.getElementById("complaint").innerHTML = xml.responseText;
        }

        document.querySelector('#category').selectedIndex = 0;
        xml.open("GET","../support/complaintList.php?status="+status);
        xml.send();

    }

}

function category()
{
    // console.log("aisefuifqiuweuf");
    var category = document.getElementById("category").value;
    console.log(category);
    
    if(category != "")
    {
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4)
                document.getElementById("complaint").innerHTML = xml.responseText;
        }

        document.querySelector('#status').selectedIndex = 0;
        xml.open("GET","../support/complaintList.php?category="+category);
        xml.send();
    }

}

window.onload = function() {
    // var select = document.querySelector('#status');
    // select.value = 'all';
    sort();
    // document.querySelector('#status').selectedIndex = 1;
};

function sortbydate()
{
    var start_date = document.getElementById("start_date").value;
    var end_date = document.getElementById("end_date").value;

    console.log(start_date+"   "+end_date);

    if(start_date == "" && end_date == "")
        return;

    var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4)
                document.getElementById("complaint").innerHTML = xml.responseText;
        }

    if(start_date != "" && end_date != "")    
        xml.open("GET","../support/complaintList.php?start_date="+start_date+"&end_date="+end_date);
    else if(start_date == "" && end_date != "")
        xml.open("GET","../support/complaintList.php?end_date="+end_date);
    else if(start_date != "" && end_date == "")
        xml.open("GET","../support/complaintList.php?start_date="+start_date);

        xml.send();

}

function addAdmin()
{
    var cmp_id = document.getElementById("cmp_id").value;
    var addAdmin = document.getElementById("addAdmin").value; 
    console.log(cmp_id+addAdmin)

    var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4)
                document.getElementById("update").innerHTML = xml.responseText;
        }
    
    
    xml.open("GET","../support/complaintList.php?cmp_id="+cmp_id+"&addAdmin="+addAdmin);
    xml.send();
    window.location.reload();

}


function StatusChange()
{
    var cmp_id = document.getElementById("cmp_id").value;
    var status = document.getElementById("statusChange").value; 
    console.log(cmp_id+status)

    var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4)
                document.getElementById("update").innerHTML = xml.responseText;
        }
    
    
    xml.open("GET","../support/complaintList.php?cmp_id="+cmp_id+"&statusChange="+status);
    xml.send();
    
    window.location.reload();
}