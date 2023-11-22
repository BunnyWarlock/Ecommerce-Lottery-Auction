/**
 * DOM element representing the element with the 'add' class.
 * @type {HTMLElement}
 */
const addBtn = document.querySelector(".add");
/**
 * DOM element representing the element with the 'inp-group' class.
 * @type {HTMLElement}
 */
const input = document.querySelector(".inp-group");

/**
 * Removes the dynamically formed input row
 */
function removeInput(){
  this.parentElement.remove();
}

/**
 * Adds a dynamically formed input row in the website.
 * Has the dropdown input item and a number input discount
 */
function addInput(){
  const item = document.createElement("select");
  item.placeholder = "Enter Item";
  item.style = "width: 50%; margin: 0;";
  item.name = "item[]";
  item.setAttribute("required", "true");

  const temp = document.createElement("option");
  temp.value = "";
  temp.text = "Select an Item";
  temp.setAttribute("disabled", "true");
  temp.setAttribute("selected", "true");
  temp.setAttribute("hidden", "true");
  item.appendChild(temp);

  for (let i = 0; i < name.length; i++){
    const option = document.createElement("option");
    option.value = id[i];
    option.text = name[i];
    item.appendChild(option);
  }

  const discount = document.createElement("input");
  discount.type = "number";
  discount.placeholder = "Enter the % Discount for the Item";
  discount.style = "width: 50%; margin: 0;";
  discount.name = "discount[]";
  discount.min = "0";
  discount.max = "100";
  discount.setAttribute("required", "true");

  const btn = document.createElement("a");
  btn.className = "delete";
  btn.innerHTML = "&times;";

  btn.addEventListener("click", removeInput);

  const flex = document.createElement("div");
  flex.className = "flex";

  input.appendChild(flex);
  flex.appendChild(item);
  flex.appendChild(discount);
  flex.appendChild(btn);
}

addBtn.addEventListener("click", addInput);
