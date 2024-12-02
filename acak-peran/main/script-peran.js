const nameListInput = document.getElementById('name-list');
const positionsContainer = document.getElementById('positions-container');
const addPositionBtn = document.getElementById('add-position');
const randomizeBtn = document.getElementById('randomize');
const resultContainer = document.getElementById('result-container');

function addPosition() {
    const newPosition = document.createElement('div');
    newPosition.classList.add('position');
    newPosition.innerHTML = `
      <input type="text" placeholder="Nama Jabatan">
      <input type="number" min="1" placeholder="Jumlah Anggota">
      <button class="delete-position">Hapus</button>
    `;
    positionsContainer.appendChild(newPosition);

    // Add event listener to the delete button
    newPosition.querySelector('.delete-position').addEventListener('click', () => {
        newPosition.remove();
    });
}

function randomize() {
  const names = nameListInput.value.split('\n').filter(name => name.trim() !== '');
  const positions = Array.from(positionsContainer.querySelectorAll('.position')).map(position => {
    const nameInput = position.querySelector('input[type="text"]');
    const amountInput = position.querySelector('input[type="number"]');
    return {
      name: nameInput.value,
      amount: parseInt(amountInput.value)
    };
  });

  // Fungsi untuk mengacak array
  function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [array[i], array[j]] = [array[j], array[i]];
    }
  }

  // Mengacak daftar nama
  shuffleArray(names);

  // Mendistribusikan nama ke masing-masing posisi
  let nameIndex = 0;
  positions.forEach(position => {
    position.members = names.slice(nameIndex, nameIndex + position.amount);
    nameIndex += position.amount;
  });

  // Menampilkan hasil dalam HTML
  resultContainer.innerHTML = '';
  positions.forEach(position => {
    const resultDiv = document.createElement('div');
    resultDiv.innerHTML = `
      <h3>${position.name}</h3>
      <ul>
        ${position.members.map(member => `<li>${member}</li>`).join('')}
      </ul>
    `;
    resultContainer.appendChild(resultDiv);
  });
}

addPositionBtn.addEventListener('click', addPosition);
randomizeBtn.addEventListener('click', randomize);

// Add event listener to existing delete button
document.querySelectorAll('.delete-position').forEach(button => {
    button.addEventListener('click', (event) => {
        event.target.parentElement.remove();
    });
});