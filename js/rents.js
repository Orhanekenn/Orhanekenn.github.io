let cardContainer;

let houses = [];


const getHouses = async() => {
    let url = "http://localhost/rent/public/rents";

    let response = await fetch(url);
    let data = await response.json();

    data.forEach(element => {
        console.log(element.is_rented);
        if(element.is_rented == 1)
            houses.push(element);
    });
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

    cardButton.onclick = async () => {
        await rentHouse(cardId.innerText);
        window.location.reload();
    }

    cardButton.innerText = "Kiradan Cikar";
    cardButton.className = 'btn btn-outline-danger';
    cardBody.append(cardId);
    cardBody.appendChild(cardTitle);
    cardBody.appendChild(cardDescription);
    cardBody.appendChild(cardButton);

    card.appendChild(cardImage);
    card.appendChild(cardBody);
    cardContainer.appendChild(card);
}

let rentHouse = (id) => {
    let url = `http://localhost/rent/public/rents/${id}`;

    var xhr = new XMLHttpRequest();
    xhr.open("PUT", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    var house = `{
        "id": ${id},
        "is_rented": "0"
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