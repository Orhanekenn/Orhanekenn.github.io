let cardContainer;

let houses = [];


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
        if(element.is_rented != 1)
            houses.push(element);
    });

    return data;
}

const createHouseCard = (house) => {
    let card = document.createElement("div");
    card.className = "card mb-4";


    let cardImage = document.createElement("img");
    cardImage.className = "card-img-top";
    cardImage.src = "./assets/bg.jpg";
    cardImage.width = 50;
    cardImage.height = 500;
    
    let cardBody = document.createElement("div");
    cardBody.className = "card-body text-center";

    let cardTitle = document.createElement('h5');
    cardTitle.innerText = house.house_name;
    cardTitle.className = 'card-title';

    let cardId = document.createElement('h5');
    cardId.innerText = house.id;

    let cardDescription = document.createElement('p');
    cardDescription.innerText = house.description  +  " \n " + house.price + "₺";
    cardDescription.className = 'card-text';


    let cardButton = document.createElement('a');

    cardButton.onclick = async() => {
        if(cardButton.innerText == "Sat")
            await sellHouse(cardId.innerText);
        else
            await rentHouse(cardId.innerText);
        
        window.location.reload();

    }

    if("is_rented" in house){
        cardButton.innerText = "Kirala";
        cardButton.className = 'btn btn-outline-warning';
    } else {
        cardButton.innerText = "Sat";
        cardButton.className = 'btn btn-outline-success';
    }
    cardBody.append(cardId);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardDescription);
    cardBody.appendChild(cardButton);

    card.appendChild(cardImage);
    card.appendChild(cardBody);
    cardContainer.appendChild(card);
}

let sellHouse = (id) => {

    let url = `https://rentapporhan.herokuapp.com/public/houses/${id}`;

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    var house = `{
        "id": ${id},
        "is_sold": "1"
    }`;

    xhr.send(house);
}

let rentHouse = (id) => {
    console.log("renting", id);
    
    let url = `https://rentapporhan.herokuapp.com/public/rents/${id}`;

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    var house = `{
        "id": ${id},
        "is_rented": "1"
    }`;

    xhr.send(house);
}

let initListOfHouses = async () => {
    await getHouses();
    if(cardContainer) {
        document.getElementById("card-container").replaceWith(cardContainer);
        return;
    }

    cardContainer = document.getElementById("card-container");
    console.log(cardContainer);

    houses.forEach(element => {
        createHouseCard(element);
    });

}

initListOfHouses();