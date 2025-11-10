 <div class="row">

     <!-- Area Chart -->
     <div class="col-xl-8 col-lg-7">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div
                 class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Today's Performace</h6>
             </div>
             <!-- Card Body -->
             <div class="card-body">
                 <div class="chart-area">
                     <canvas id="agentChart"></canvas>
                 </div>
             </div>
         </div>
     </div>

     <!-- Pie Chart -->
     <div class="col-xl-4 col-lg-5">
         <div class="card shadow mb-4">
             <!-- Card Header - Dropdown -->
             <div
                 class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                 <h6 class="m-0 font-weight-bold text-primary">Finished Task Today</h6>
             </div>
             <!-- Card Body -->
             <div class="card-body">
                 <div class="align-items-center justify-content-center text-center">
                     <h1><?= $total_task_today; ?></h1>
                 </div>
                 <!-- <div class="chart-pie pt-4 pb-2">
                     <canvas id="myPieChart"></canvas>
                 </div> -->
                 <!-- <div class="mt-4 text-center small">
                     <span class="mr-2">
                         <i class="fas fa-circle text-primary"></i> Direct
                     </span>
                     <span class="mr-2">
                         <i class="fas fa-circle text-success"></i> Social
                     </span>
                     <span class="mr-2">
                         <i class="fas fa-circle text-info"></i> Referral
                     </span>
                 </div> -->
             </div>
         </div>
     </div>
 </div>

 </div>

 </div>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 <script>
     const agentResult = <?= json_encode($agent_result); ?>;

     const labels = agentResult.map(item => item.result_label);
     const totals = agentResult.map(item => parseInt(item.total));

     const ctx = document.getElementById('agentChart').getContext('2d');

     new Chart(ctx, {
         type: 'bar',
         data: {
             labels: labels,
             datasets: [{
                 label: 'Total per Result',
                 data: totals,
                 backgroundColor: [
                     'rgba(46, 204, 113, 0.5)', // PAID
                     'rgba(52, 152, 219, 0.5)', // PTP
                     'rgba(241, 196, 15, 0.5)', // MSG
                     'rgba(231, 76, 60, 0.5)', // NOAN
                     'rgba(155, 89, 182, 0.5)' // BPH
                 ],
                 borderColor: [
                     'rgba(46, 204, 113, 1)',
                     'rgba(52, 152, 219, 1)',
                     'rgba(241, 196, 15, 1)',
                     'rgba(231, 76, 60, 1)',
                     'rgba(155, 89, 182, 1)'
                 ],
                 borderWidth: 1
             }]
         },
         options: {
             responsive: true,
             scales: {
                 y: {
                     beginAtZero: true,
                     ticks: {
                         precision: 0
                     }
                 }
             }
         }
     });
 </script>