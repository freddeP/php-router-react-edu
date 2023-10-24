console.log("not a test anymore");

let x = 12;

getQuotes();
async function getQuotes(){

    let response = await fetch("php-router2023/quotes");
    let quotes = await response.json();

    document.querySelector(".quotes pre").innerHTML = JSON.stringify(quotes,null, 2);


}