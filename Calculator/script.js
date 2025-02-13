alert(
  "this is simple calculater to calculate sum, difference, product, division, power, roots, factorial, remainder and to indicate the type of your input. \nhappy calculation time!!! 😊👍"
);
// Select elements
setInterval(() => {
  let now = new Date();
  document.getElementById(
    "now"
  ).innerText = `TIME is ${now.toLocaleTimeString()}`;
}, 1000);
let num1 = document.getElementById("num1");
console.log(num1);
let num2 = document.getElementById("num2");
console.log(num2);
let date = document.getElementById("date");
let time = document.getElementById("time");
let but1 = document.getElementById("but1");
let but2 = document.getElementById("but2");
let but3 = document.getElementById("but3");
let but4 = document.getElementById("but4");
let but5 = document.getElementById("but5");
let but6 = document.getElementById("but6");
let but7 = document.getElementById("but7");
let but8 = document.getElementById("but8");
let but9 = document.getElementById("but9");
let but10 = document.getElementById("but10");
let form = document.getElementById("form");
console.log(form);
// Add an event listener to the button
but1.addEventListener("click", (e) => {
  e.preventDefault();
   document.body.style.backgroundColor = "green"; // Change background color on click
  let sum = parseFloat(num1.value) + parseFloat(num2.value);
  console.log(sum);
  let result = document.getElementById("result");
  result.innerText = `the sum of the two numbers is \n \n ${sum}`;
  result.className = "result";
});
but2.addEventListener("click", (e) => {
  e.preventDefault();
  let sub = parseFloat(num1.value) - parseFloat(num2.value);
  console.log(sub);
  let result = document.getElementById("result");
  result.innerText = the difference of the two numbers is \n \n ${sub};
  result.className = "result";
});
but3.addEventListener("click", (e) => {
  e.preventDefault();
  let mul = parseFloat(num1.value) * parseFloat(num2.value);
  console.log(mul);
  let result = document.getElementById("result");
  result.innerText = the product of the two numbers is \n \n ${mul};
  result.className = "result";
});
but4.addEventListener("click", (e) => {
  e.preventDefault();
  let dev = parseFloat(num1.value) / parseFloat(num2.value);
  console.log(dev);
  let result = document.getElementById("result");
  result.innerText = the factor of the two numbers is \n \n ${dev};
  result.className = "result";
});
but5.addEventListener("click", (e) => {
  e.preventDefault();
  let rem = parseInt(num1.value) % parseInt(num2.value);
  console.log(rem);
  let result = document.getElementById("result");
  result.innerText = the remainder  is \n \n ${rem};
  result.className = "result";
});
but6.addEventListener("click", (e) => {
  e.preventDefault();
  let pow = parseFloat(num1.value) ** parseFloat(num2.value);
  console.log(pow);
  let result = document.getElementById("result");
  result.innerText = `${num1.value} raisedto ${num2.value} is\n \n ${pow}`;
  result.className = "result";
});
but7.addEventListener("click", (e) => {
  e.preventDefault();
  let root = parseInt(num1.value) ** (1 / parseInt(num2.value));
  console.log(root);
  let result = document.getElementById("result");
  result.innerText = `the ${num2.value}th root of ${num1.value} \n is \n ${root}`;
  result.className = "result";
});
but8.addEventListener("click", (e) => {
  e.preventDefault();
  let factorial1 = fact(parseFloat(num1.value));
  console.log(factorial1);
  let factorial2 = fact(parseFloat(num2.value));
  console.log(factorial2);
  let result = document.getElementById("result");
  result.innerText = `the factorial of the first numbers is \n ${factorial1}\n and the second number\n${factorial2}`;
  result.className = "result";
});
but9.addEventListener("click", (e) => {
  e.preventDefault();
  let type1 = isNaN(num1.value);
  console.log(type1);
  let type2 = isNaN(num2.value);
  console.log(type2);
  let result = document.getElementById("result");
  result.innerText = `1.the type of the first input is number   \n  ${!type1} \n 2.the type of the first input is number \n${!type2}`;
  result.className = "result";
});
but10.addEventListener("click", (e) => {
  e.preventDefault();
  document.body.style.backgroundColor = "green";
  let equal = num1.value == num2.value;
  console.log(equal);
  let result = document.getElementById("result");
  result.innerText = `Is the two number are equal? \n \n ${equal}`;
  result.className = "result";
});
function fact(n) {
  if (n <= 1) return 1;
  else return n * fact(n - 1);
}
date.addEventListener("click", () => {
  let date1 = new Date();
  let result = document.getElementById("result");
  result.innerText = `today is \n \n ${date1.toLocaleDateString()}`;
  result.className = "result";
});
time.addEventListener("click", () => {
  let date1 = new Date();
  let result = document.getElementById("result");
  result.innerText = `the time now is \n \n ${date1.toLocaleTimeString()}`;
  result.className = "result";
});
