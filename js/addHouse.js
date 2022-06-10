
let addHouse = async () => {
    let tmpid = document.getElementById("inpId").value;
    let tmpname = document.getElementById("inpName").value;
    let tmplocation = document.getElementById("inpLocation").value;
    let tmpdescription = document.getElementById("inpDescription").value;
    let tmpprice = document.getElementById("inpPrice").value;
    let tmptype = document.querySelector('input[name="rate"]:checked').value;
    
    if (tmptype == "rent"){

    }

    let house = {
        id: tmpid,
        house_name: tmpname,
        location: tmplocation,
        description: tmpdescription,
        price: tmpprice,
    }
    if(tmptype == "rent")
        house["is_rented"] = 0;
    else
        house["is_sold"] = 0; 


    
    let url = tmptype == "rent" ? "http://localhost/rent/public/rents" : "http://localhost/rent/public/houses";
    console.log(url);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(house));

    
}