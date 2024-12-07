// Get DOM elements
const nameListInput = document.getElementById('name-list');
const positionsContainer = document.getElementById('positions-container');
const addPositionBtn = document.getElementById('add-position');
const randomizeBtn = document.getElementById('randomize');
const resultContainer = document.getElementById('result-container');
const downloadBtn = document.getElementById('download-results');

let positions = [];

// Function to add a new position input
function addPosition() {
    const newPosition = document.createElement('div');
    newPosition.classList.add('position');
    newPosition.innerHTML = `
      <input type="text" placeholder="Nama Jabatan">
      <input type="number" min="1" placeholder="Jumlah Anggota">
      <button class="delete-position">Hapus</button>
    `;
    positionsContainer.appendChild(newPosition);
    newPosition.querySelector('.delete-position').addEventListener('click', () => newPosition.remove());
}

// Function to randomize names into positions
function randomize() {
  const names = nameListInput.value.split('\n').filter(name => name.trim() !== '');
  positions = Array.from(positionsContainer.querySelectorAll('.position')).map(position => ({
    name: position.querySelector('input[type="text"]').value,
    amount: parseInt(position.querySelector('input[type="number"]').value)
  }));

  // Shuffle the names array
  names.sort(() => Math.random() - 0.5);

  // Distribute names to each position
  let nameIndex = 0;
  positions.forEach(position => {
    position.members = names.slice(nameIndex, nameIndex + position.amount);
    nameIndex += position.amount;
  });

  // Display the results in HTML
  resultContainer.innerHTML = positions.map(position => `
    <div>
      <h3>${position.name}</h3>
      <ul>${position.members.map(member => `<li>${member}</li>`).join('')}</ul>
    </div>
  `).join('');
}

// Function to download the results as a text file
function downloadResults() {
  const resultText = positions.map(position => `
    ${position.name}
    ${position.members.map(member => `- ${member}`).join('\n')}
  `).join('\n\n');

  const blob = new Blob([resultText], { type: 'text/plain' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'hasil-acak-peran.txt';
  a.click();
  URL.revokeObjectURL(url);
}

// Add event listeners to buttons
[addPositionBtn, randomizeBtn, downloadBtn].forEach((btn, i) => {
  btn.addEventListener('click', [addPosition, randomize, downloadResults][i]);
});

// Add event listener to existing delete buttons
document.querySelectorAll('.delete-position').forEach(button => {
    button.addEventListener('click', (event) => event.target.parentElement.remove());
});