const startInput = document.getElementById('start');
const endInput = document.getElementById('end');
const amountInput = document.getElementById('amount');
const resultsDiv = document.getElementById('results');
const randomizeBtn = document.getElementById('randomize-btn');
const resetBtn = document.getElementById('reset-btn');

function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = getRandomInt(i + 1);
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

function generateRandomNumbers() {
  const start = parseInt(startInput.value);
  const end = parseInt(endInput.value);
  const amount = parseInt(amountInput.value);

  if (start >= end || amount <= 0) {
    alert('Batas bawah harus lebih kecil dari batas atas dan jumlah angka harus minimal 1!');
    return;
  }

  const numbers = [];
  for (let i = start; i <= end; i++) {
    numbers.push(i);
  }

  const shuffledNumbers = shuffleArray(numbers).slice(0, amount);
  shuffledNumbers.sort((a, b) => a - b); // Sort numbers in ascending order
  resultsDiv.innerHTML = shuffledNumbers.join(', ');
}

randomizeBtn.addEventListener('click', generateRandomNumbers);

resetBtn.addEventListener('click', () => {
  startInput.value = '';
  endInput.value = '';
  amountInput.value = '';
  resultsDiv.innerHTML = '';
});