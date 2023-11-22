let rotationValues = [
  { minDegree: 0, maxDegree: 179, value: 1},
  { minDegree: 180, maxDegree: 287, value: 2},
  { minDegree: 288, maxDegree: 323, value: 3},
  { minDegree: 324, maxDegree: 351, value: 4},
  { minDegree: 352, maxDegree: 359, value: 5},
];

function getWinner(angleValue){
  let check;
  for (let i of rotationValues){
    if (i.minDegree+angleValue < 360 && i.maxDegree+angleValue > 360)
      check = ((i.minDegree+angleValue)%360 <= 90 || (i.maxDegree+angleValue)%360 >= 90);
    else
      check = ((i.minDegree+angleValue)%360 <= 90 && (i.maxDegree+angleValue)%360 >= 90);
    if (check){
      return i.value;
      //index = (Math.floor(Math.random() * lotteryPrizes[i.value].length));
      //finalValue.innerHTML = `<p>Congratulations you got a ${lotteryPrizes[i.value][index]["discount"]}% discount on ${prizeName[lotteryPrizes[i.value][index]["itemID"]]}</p>`;
      //spinBtn.disabled = false;
      //break;
    }
  }
  if (spinBtn.disabled){
    return -1;
    //console.log(angleValue);
    //finalValue.innerHTML = `<p>No Luck: Try Again</p>`;
    //spinBtn.disabled = false;
  }
}
