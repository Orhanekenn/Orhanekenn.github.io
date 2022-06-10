let solds =[]
let houses= []
let rents= []

const getSoldHouses = async() => {
    let url = "https://rentapporhan.herokuapp.com/public/houses";

    let response = await fetch(url);
    let data = await response.json();

    data.forEach(element => {
        console.log(element.is_sold);
        if(element.is_sold == 1)
        solds.push(element);
    });

    document.getElementById("numberOfSold").innerText = solds.length;
}

const getRentedHouses = async() => {
    let url = "https://rentapporhan.herokuapp.com/public/rents";

    let response = await fetch(url);
    let data = await response.json();

    data.forEach(element => {
        console.log(element.is_sold);
        if(element.is_rented == 1)
        rents.push(element);
    });

    document.getElementById("numberOfRented").innerText = rents.length;
}

const getHouses = async() => {
    let url = "https://rentapporhan.herokuapp.com/public/houses";

    let response = await fetch(url);
    let data = await response.json();

    data.forEach(element => {
        console.log(element.is_sold);
        if(element.is_sold != 1)
        houses.push(element);
    });

    let url2 = "https://rentapporhan.herokuapp.com/public/rents";

    let response2 = await fetch(url2);
    let data2 = await response2.json();

    data2.forEach(element => {
        console.log(element.is_sold);
        if(element.is_rented != 1)
        houses.push(element);
    });

    console.log(houses.length);


    document.getElementById("numberOfHouse").innerText = houses.length;
}





getSoldHouses();
getRentedHouses();
getHouses();