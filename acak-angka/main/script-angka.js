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

function saveResults(numbers) {
  fetch('save-results-db.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ results: numbers })
  })
  .then(response => response.text())
  .then(data => {
    console.log('Success:', data);
  })
  .catch((error) => {
    console.error('Error:', error);
  });
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
  saveResults(shuffledNumbers); // Save the results
}

randomizeBtn.addEventListener('click', generateRandomNumbers);

resetBtn.addEventListener('click', () => {
  startInput.value = '';
  endInput.value = '';
  amountInput.value = '';
  resultsDiv.innerHTML = '';
});

document.getElementById('save-btn').addEventListener('click', function() {
  const results = document.getElementById('results').innerText;
  if (results) {
    const blob = new Blob([results], { type: 'text/plain' });
    const anchor = document.createElement('a');
    anchor.download = 'hasil-acak-angka.txt';
    anchor.href = window.URL.createObjectURL(blob);
    anchor.target = '_blank';
    anchor.style.display = 'none'; // Make sure it's not visible
    document.body.appendChild(anchor);
    anchor.click();
    document.body.removeChild(anchor);
    alert('Hasil disimpan!');
  } else {
    alert('Tidak ada hasil untuk disimpan.');
  }
});