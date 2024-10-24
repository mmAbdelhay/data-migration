<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Migration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/javascript/javascript.min.js"></script>
</head>
<body class="bg-gray-100 p-6">
<div class="flex">
    <!-- Sidebar for Database Structure -->
    <div class="w-1/3 p-4 bg-gray-200 overflow-y-auto h-screen">
        <h2 class="font-bold text-lg mb-4">Database Structure</h2>
        <ul id="database-structure" class="space-y-2"></ul>
    </div>

    <!-- Main Form Area -->
    <div class="w-2/3 p-8 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Data Migration</h1>
        <form action="/migrate-data" method="POST">
            <!-- CSRF Token -->
            @csrf

            <!-- Table From -->
            <div class="mb-4">
                <label for="table_from" class="block text-gray-700 font-medium">Table From:</label>
                <input type="text" id="table_from" name="table_from" required
                       class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- To Type -->
            <div class="mb-4">
                <label for="to_type" class="block text-gray-700 font-medium">To Type:</label>
                <select id="to_type" name="to_type" required
                        class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="table">Table</option>
                    <option value="api">API</option>
                </select>
            </div>

            <!-- Table To -->
            <div id="table_to_container" class="mb-4">
                <label for="table_to" class="block text-gray-700 font-medium">Table To:</label>
                <input type="text" id="table_to" name="table_to"
                       class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- API URL -->
            <div id="api_url_container" class="mb-4 hidden">
                <label for="api_url" class="block text-gray-700 font-medium">API URL:</label>
                <input type="text" id="api_url" name="api_url"
                       class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                <label for="api_method" class="block text-gray-700 font-medium mt-4">API Method:</label>
                <select id="api_method" name="api_method"
                        class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="GET">GET</option>
                    <option value="POST">POST</option>
                    <option value="PUT">PUT</option>
                    <option value="DELETE">DELETE</option>
                </select>

                <label for="api_access_token" class="block text-gray-700 font-medium mt-4">API Access Token:</label>
                <input type="text" id="api_access_token" name="api_access_token"
                       class="mt-1 w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                <label for="api_payload" class="block text-gray-700 font-medium mt-4">API Payload (JSON):</label>
                <textarea id="api_payload" name="api_payload" rows="4"
                          class="hidden"></textarea>
                <div id="api_payload_editor" class="border border-gray-300 rounded-md"></div>
            </div>

            <!-- Columns From -->
            <div class="mb-4">
                <label for="columns_from" class="block text-gray-700 font-medium">Columns From (JSON):</label>
                <textarea id="columns_from" name="columns_from" rows="4"
                          class="hidden" required></textarea>
                <div id="columns_from_editor" class="border border-gray-300 rounded-md"></div>
            </div>

            <!-- Columns To -->
            <div class="mb-4">
                <label for="columns_to" class="block text-gray-700 font-medium">Columns To (JSON):</label>
                <textarea id="columns_to" name="columns_to" rows="4"
                          class="hidden"></textarea>
                <div id="columns_to_editor" class="border border-gray-300 rounded-md"></div>
            </div>

            <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition-colors">
                Migrate Data
            </button>
        </form>
    </div>
</div>

<script>
    // Fetch the database structure from the backend
    fetch('/api/database-structure')
        .then(response => response.json())
        .then(structure => {
            const list = document.getElementById('database-structure');
            for (const [table, columns] of Object.entries(structure)) {
                const tableItem = document.createElement('li');
                tableItem.classList.add('font-medium');
                tableItem.textContent = table;

                const columnList = document.createElement('ul');
                columnList.classList.add('ml-4', 'space-y-1');

                columns.forEach(column => {
                    const columnItem = document.createElement('li');
                    columnItem.textContent = column;
                    columnItem.classList.add('cursor-pointer', 'text-blue-500', 'hover:underline');

                    // Add click event to populate JSON editor
                    columnItem.addEventListener('click', () => {
                        // Logic to add column to the JSON editor for mapping
                    });

                    columnList.appendChild(columnItem);
                });

                tableItem.appendChild(columnList);
                list.appendChild(tableItem);
            }
        })
        .catch(error => console.error('Error fetching database structure:', error));

    // Initialize CodeMirror editors for JSON fields
    const columnsFromEditor = CodeMirror(document.getElementById('columns_from_editor'), {
        mode: "application/json",
        lineNumbers: true,
        theme: "default"
    });

    const columnsToEditor = CodeMirror(document.getElementById('columns_to_editor'), {
        mode: "application/json",
        lineNumbers: true,
        theme: "default"
    });

    const apiPayloadEditor = CodeMirror(document.getElementById('api_payload_editor'), {
        mode: "application/json",
        lineNumbers: true,
        theme: "default"
    });

    // Sync CodeMirror content with hidden textarea before form submission
    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('columns_from').value = columnsFromEditor.getValue();
        document.getElementById('columns_to').value = columnsToEditor.getValue();
        document.getElementById('api_payload').value = apiPayloadEditor.getValue();
    });

    // Toggle visibility of fields based on 'to_type' selection
    document.getElementById('to_type').addEventListener('change', function () {
        const toType = this.value;
        document.getElementById('table_to_container').classList.toggle('hidden', toType !== 'table');
        document.getElementById('api_url_container').classList.toggle('hidden', toType !== 'api');
    });
</script>
</body>
</html>
