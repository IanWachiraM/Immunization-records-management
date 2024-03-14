document.getElementById('myInfo').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
    var patientId = document.getElementById('patient_ID').value;
  
    // Send patient ID to the server
    fetch('childinfo.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ patientId: patientId })
    })
    .then(response => response.json())
    .then(data => {
      // Display patient information in a table
      displayPatientInfo(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
  });
  
  function displayPatientInfo(data) {
    // Create HTML table to display patient information
    // Iterate through data and populate the table
  }
  