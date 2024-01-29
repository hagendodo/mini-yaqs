<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <canvas id="myChart" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Step 1: Parse JSON data
        const jsonData = {!! json_encode($visitors) !!};

        // Step 2: Filter data based on selected month
        function filterDataByMonth(data, month) {
            return data.filter(entry => new Date(entry.date).getMonth() === month - 1);
        }

        // Step 3: Plot filtered data on Chart.js chart
        function plotChart(data) {
            const ctx = document.getElementById('myChart').getContext('2d');
            const dates = data.map(entry => entry.date);
            const counts = data.map(entry => entry.count);

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Visitor',
                        data: counts,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Filter data for January (Month number: 1)
        const filteredData = filterDataByMonth(jsonData, 1);

        // Plot the chart with filtered data
        plotChart(filteredData);
    </script>

</x-app-layout>
