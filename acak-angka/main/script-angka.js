const elements = ['start', 'end', 'amount', 'results', 'randomize-btn', 'reset-btn', 'save-btn'].reduce((acc, id) => {
  acc[id] = document.getElementById(id);
  return acc;
}, {});

const { start, end, amount, results, 'randomize-btn': randomizeBtn, 'reset-btn': resetBtn, 'save-btn': saveBtn } = elements;

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

function saveResults(results) {
  const blob = new Blob([results], { type: 'text/plain' });
  const anchor = document.createElement('a');
  anchor.download = 'hasil-acak-angka.txt';
  anchor.href = window.URL.createObjectURL(blob);
  anchor.target = '_blank';
  anchor.style.display = 'none';
  document.body.appendChild(anchor);
  anchor.click();
  document.body.removeChild(anchor);
}

function saveResultsToDatabase(results) {
  const id_user = sessionStorage.getItem('id_user');
  if (!id_user) {
    alert('User ID is not set. Please log in again.');
    return;
  }
  console.log('Sending data to save-results.php:', {
    result: results,
    id_user: id_user
  });
  fetch('save-results.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      result: results,
      id_user: id_user
    })
  })
  .then(response => response.json())
  .then(data => {
    console.log('Response from save-results.php:', data);
    if (data.success) {
      alert('Hasil berhasil disimpan ke database.');
    } else {
      alert('Gagal menyimpan hasil ke database.');
      console.error('Error details:', data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat menyimpan hasil ke database.');
  });
}

function clearInputs() {
  ['start', 'end', 'amount'].forEach(id => elements[id].value = '');
  results.innerHTML = '';
}

function validateInputs(startValue, endValue, amountValue) {
  if ([startValue, endValue, amountValue].some(isNaN)) {
    alert('Please enter valid numbers for start, end, and amount.');
    return false;
  }
  if (startValue >= endValue) {
    alert('Start value must be less than end value.');
    return false;
  }
  if (amountValue <= 0 || amountValue > (endValue - startValue + 1)) {
    alert('Amount must be a positive number and less than or equal to the range.');
    return false;
  }
  return true;
}



function generateRandomNumbers() {
  const startValue = parseInt(start.value);
  const endValue = parseInt(end.value);
  const amountValue = parseInt(amount.value);

  if (!validateInputs(startValue, endValue, amountValue)) return;

  const numbers = Array.from({ length: endValue - startValue + 1 }, (_, i) => i + startValue);
  const shuffledNumbers = shuffleArray(numbers).slice(0, amountValue).sort((a, b) => a - b);
  results.innerHTML = shuffledNumbers.join(', ');
}

function handleButtonClick(event) {
  if (event.target === randomizeBtn) {
    generateRandomNumbers();
  } else if (event.target === resetBtn) {
    clearInputs();
  }
}

function handleSaveButtonClick() {
  const resultsText = results.textContent;
  if (resultsText) {
    const resultsFormatted = `Ambang bawah: ${start.value}\nAmbang atas: ${end.value}\nBanyak angka: ${amount.value}\nAngka terpilih: ${resultsText}`;
    saveResults(resultsFormatted);
    saveResultsToDatabase(resultsFormatted);
  } else {
    alert('Tidak ada hasil untuk disimpan.');
  }
}

[randomizeBtn, resetBtn].forEach(btn => btn.addEventListener('click', handleButtonClick));
saveBtn.addEventListener('click', handleSaveButtonClick);