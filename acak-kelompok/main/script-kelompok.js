window.divideIntoGroups = function(names, numberOfGroups) {
  // Shuffle the names array
  for (let i = names.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [names[i], names[j]] = [names[j], names[i]];
  }

  // Create the groups
  const groups = Array.from({ length: numberOfGroups }, () => []);
  names.forEach((name, index) => {
    groups[index % numberOfGroups].push(name);
  });

  return groups;
};

function downloadGroups(groups) {
  let content = "Kelompok yang terbuat:\n\n";
  groups.forEach((group, index) => {
    content += `Group ${index + 1}:\n`;
    group.forEach(name => {
      content += `- ${name}\n`;
    });
    content += "\n";
  });

  const blob = new Blob([content], { type: "text/plain;charset=utf-8" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = "group-results.txt";
  link.click();
}

function displayGroups(groups) {
  const resultContainer = document.getElementById('result-container');
  resultContainer.innerHTML = ''; // Clear previous results
  groups.forEach((group, index) => {
    const groupDiv = document.createElement('div');
    groupDiv.classList.add('group');
    groupDiv.innerHTML = `<h3>Kelompok ${index + 1}</h3><ul>${group.map(name => `<li>${name}</li>`).join('')}</ul>`;
    resultContainer.appendChild(groupDiv);
  });
}

let currentGroups = [];