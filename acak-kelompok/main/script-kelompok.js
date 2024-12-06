const numGroupsInput = document.getElementById('num-groups');
const nameListInput = document.getElementById('name-list');
const randomizeBtn = document.getElementById('randomize-btn');
const resetBtn = document.getElementById('reset-btn');
const resultContainer = document.getElementById('result-container');

const downloadBtn = document.getElementById('download-btn');

function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}

function groupByN(list, numGroups) {
  const shuffledList = shuffleArray(list.split('\n'));
  const groups = [];
  for (let i = 0; i < numGroups; i++) {
    groups.push([]);
  }

  for (let i = 0; i < shuffledList.length; i++) {
    groups[i % numGroups].push(shuffledList[i]);
  }

  return groups;
}

function downloadGroups(groups) {
  let content = '';
  groups.forEach((group, index) => {
    content += `Kelompok ${index + 1}: ${group.join(', ')}\n`;
  });

  const blob = new Blob([content], { type: 'text/plain' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'hasil_kelompok.txt';
  a.click();
  URL.revokeObjectURL(url);
}

let currentGroups = [];

randomizeBtn.addEventListener('click', () => {
  const numGroups = parseInt(numGroupsInput.value);
  const names = nameListInput.value;

  if (numGroups <= 0 || names.trim() === '') {
    alert('Jumlah kelompok harus lebih dari 0 dan daftar nama tidak boleh kosong.');
    return;
  }

  currentGroups = groupByN(names, numGroups);

  resultContainer.innerHTML = '';
  currentGroups.forEach((group, index) => {
    const groupDiv = document.createElement('div');
    groupDiv.textContent = `Kelompok ${index + 1}: ${group.join(', ')}`;
    resultContainer.appendChild(groupDiv);
  });

  downloadBtn.style.display = 'block';
});

downloadBtn.addEventListener('click', () => {
  downloadGroups(currentGroups);
});

resetBtn.addEventListener('click', () => {
  numGroupsInput.value = 1;
  nameListInput.value = '';
  resultContainer.innerHTML = '';
  downloadBtn.style.display = 'none';
  currentGroups = [];
});