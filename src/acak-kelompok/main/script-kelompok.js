const numGroupsInput = document.getElementById('num-groups');
const nameListInput = document.getElementById('name-list');
const randomizeBtn = document.getElementById('randomize-btn');
const resetBtn = document.getElementById('reset-btn');
const resultContainer = document.getElementById('result-container');

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

randomizeBtn.addEventListener('click', () => {
  const numGroups = parseInt(numGroupsInput.value);
  const names = nameListInput.value;

  if (numGroups <= 0 || names.trim() === '') {
    alert('Jumlah kelompok harus lebih dari 0 dan daftar nama tidak boleh kosong.');
    return;
  }

  const groups = groupByN(names, numGroups);

  resultContainer.innerHTML = '';
  groups.forEach((group, index) => {
    const groupDiv = document.createElement('div');
    groupDiv.textContent = `Kelompok ${index + 1}: ${group.join(', ')}`;
    resultContainer.appendChild(groupDiv);
  });
});

resetBtn.addEventListener('click', () => {
  numGroupsInput.value = 1;
  nameListInput.value = '';
  resultContainer.innerHTML = '';
});