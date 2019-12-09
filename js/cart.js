// Items
let item1 = document.getElementById("quantity1");
let item1subtotal = document.getElementById("subtotal1");
let item2 = document.getElementById("quantity2");
let item2subtotal = document.getElementById("subtotal2");
let item3 = document.getElementById("quantity3");
let item3subtotal = document.getElementById("subtotal3");
let item4 = document.getElementById("quantity4");
let item4subtotal = document.getElementById("subtotal4");
let item5 = document.getElementById("quantity5");
let item5subtotal = document.getElementById("subtotal5");
let item6 = document.getElementById("quantity6");
let item6subtotal = document.getElementById("subtotal6");
let paymentfields = document.getElementById("paymentinfo").getElementsByTagName('input');
let selectstate = document.getElementById("state");
//Checkout Totals
let subtotaltext = document.getElementById("subtotal");
let taxtext = document.getElementById("tax");
let shippingtext = document.getElementById("shipping");
let totaltext = document.getElementById("total");
//Track item totals
let quantity = [0,0,0,0,0,0];
let products = ["Circle Logo T-Shirt", "Color Bar T-Shirt", "Square Logo T-Shirt", "Orbit T-Shirt", "Round Sticker", "Triangle Sticker"];
let totals = [0,0,0,0,0,0];
//Buttons
let isPickup = document.getElementById("pickup");
let isShipping = document.getElementById("shiptohome");
let submitbutton = document.getElementById("submitbutton");
//Totals
let shippingcost = 0;
let taxamount = 0;
let totalcost = 0;

item1.addEventListener("input", function() {
  total(item1, item1subtotal, 10, 0);
});

item2.addEventListener("input", function() {
  total(item2, item2subtotal, 10, 1);
});

item3.addEventListener("input", function() {
  total(item3, item3subtotal, 10, 2);
});

item4.addEventListener("input", function() {
  total(item4, item4subtotal, 10, 3);
});

item5.addEventListener("input", function() {
  total(item5, item5subtotal, 5, 4);
});

item6.addEventListener("input", function(){
  total(item6, item6subtotal, 5, 5);
});

isPickup.addEventListener("click", function(){
  shipping();
});

isShipping.addEventListener("click", function(){
  shipping();
});

submitbutton.addEventListener("click", function(event){
  validateFields(event);
});

function total(item, itemsubtotal, cost, index){
  let subtotal = item.value * cost;
  if(isNaN(subtotal) || subtotal < 0){
    itemsubtotal.value = "Invalid Quantity";
  }
  else{
  // Display item cost whenever item is updated
  itemsubtotal.value = "$" + subtotal.toFixed(2);
  // Update item cost in array
  quantity[index] = item.value * 1;
  totals[index] = subtotal;
  // Sum item costs
  var mytotalcost = 0;
  for (var i = 0; i < totals.length; i++) {
  mytotalcost += totals[i];
  }
  totalcost = mytotalcost;
  //Display subtotal
  subtotaltext.value = "$" + mytotalcost.toFixed(2);
  //Calculate tax
  taxamount = (totalcost * 0.08);
  taxtext.value = "$" + taxamount.toFixed(2);
  }
  updateTotals();
}

function shipping(){
  if(isPickup.checked){
  shippingtext.value = "$0.00";
  shippingcost = 0;
    }
  else if(isShipping.checked){
  shippingtext.value = "$7.00";
  shippingcost = 7;
  }
  updateTotals();
}

function updateTotals(){
  let checkouttotal = shippingcost + taxamount + totalcost;
  totaltext.value = "$" + checkouttotal.toFixed(2);
}

function receipt(){
  if(validateFields()){
    let newdiv = document.createElement("div");
    newdiv.className = "receipt-item";
    let container = document.getElementsByClassName("content")[0];
    // Add title
    let title = document.createElement("h1");
    title.innerText = "Receipt";
    newdiv.appendChild(title);
    // Add info from form
    let creditcardnum = paymentfields[6].value;
    let outputnode = document.createElement("p");
    let date = new Date();
    let datestring = date.getMonth()+1 + "/" + date.getDate() + "/" + date.getFullYear();
    let productstring = "";
    let didBuyProduct = false;
    for (var i = 0; i < quantity.length; i++) {
      if(quantity[i] > 0){
        productstring += quantity[i] + "x " + products[i] + "<br>";
        didBuyProduct = true;
      }
    }
    if(!didBuyProduct){
      productstring = "None<br>";
    }
    outputnode.className = "output";
    let checkoutinfo =
    "Date: " + datestring + "<br><br>" +
    "Shipping Method: " + (isPickup.checked ? "Pick Up" : "Ship to Home") + "<br><br>" +
    "Name: " + paymentfields[0].value + "<br><br>" +
    "Phone Number: " + paymentfields[1].value + "<br><br>" +
    "Email Address: " + paymentfields[2].value + "<br><br>" +
    "Address: " + paymentfields[3].value + "<br><br>" +
    "State: " + selectstate.options[selectstate.selectedIndex].value + "<br><br>" +
    "Zip Code: " + paymentfields[5].value + "<br><br>" +
    "Credit Card #: " + "*".repeat(creditcardnum.length - 4) + creditcardnum.substr(creditcardnum.length - 4) + "<br><br>" +
    "Bought Products: <br>" + productstring + "<br>" +
    "Subtotal: " + subtotaltext.value + "<br><br>" +
    "Tax: " + taxtext.value + "<br><br>" +
    "Shipping: " + shippingtext.value + "<br><br>" +
    "Total: " + totaltext.value + "<br><br>";
    // Append info to newly created div
    outputnode.innerHTML = checkoutinfo;
    newdiv.appendChild(outputnode);
    //Add new flexbox to container
    container.appendChild(newdiv);
    clear();
  }
}

function validateFields(event){
  if(totalcost == 0){
    event.preventDefault();
    alert("You have not ordered anything");
    return false;
  }
  for(var item in paymentfields){
    if (paymentfields.hasOwnProperty(item)) {
      // console.log(item);
      if(paymentfields[item].value == ""){
        highlightField(paymentfields[item]);
        event.preventDefault();
        alert(paymentfields[item].placeholder + " cannot be empty");
        return false;
      }
      if(paymentfields[item].id == "zipcode"){
        if(isNaN(paymentfields[item].value) || paymentfields[item].value.length != 5){
          highlightField(paymentfields[item]);
          event.preventDefault();
          alert("Invalid Zip Code - Must be 5 digits");
          return false;
        }
      }
      if(paymentfields[item].id == "paymentemail"){
        //Regex test
        let emailtest = /^\w+[@]\w+[.]\D+$/;
        if(emailtest.test(paymentfields[item].value) == false){
          highlightField(paymentfields[item]);
          event.preventDefault();
          alert("Invalid Email");
          return false;
        }
      }
      if(paymentfields[item].id == "creditcard"){
        if(isNaN(paymentfields[item].value) || paymentfields[item].value.length < 13){
          highlightField(paymentfields[item]);
          event.preventDefault();
          alert("Invalid Credit Card # - Must be at least 13 digits");
          return false;
        }
      }
    }
  }
  return true;
}

function highlightField(object){
  object.focus();
  object.select();
  object.style.backgroundColor = "red";
  object.addEventListener("input", function(){
    object.style.backgroundColor = "white";
  });
}

function clear(){
  paymentfields = document.getElementById("paymentinfo").getElementsByTagName('input');
  for(var item in paymentfields){
    if (paymentfields.hasOwnProperty(item)) {
    paymentfields[item].value = "";
    }
  }
}
