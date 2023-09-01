<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <link rel="stylesheet" href="style.css" /> -->
  <title>Document</title>
</head>

<body>
  <div class="px-4 sm:px-6 lg:px-8 min-h-[100vh] flex flex-col">
    <h1 class="text-3xl font-bold text-inherit p-10">Time Tracking</h1>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
              <thead class="bg-gray-50">
                <tr class="text-center">
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-sm font-semibold text-gray-900 sm:pl-6">
                    No
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900">
                    Staff Name
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900">
                    Start
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900">
                    Stop
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900">
                    Request
                  </th>
                  <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-gray-900">
                    Status
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y text-center divide-gray-200 bg-white" id="staff-list">
                <!-- {result_array.map((data, index) => (
                <h1>dddd</h1>
                ))} -->
              </tbody>
            </table>
          </div>
          <div class="flex justify-center mt-5">
            <!-- Previous Button -->
            <button onclick="previous();"
              class="flex items-center justify-center px-4 h-10 mr-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
              <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13 5H1m0 0 4 4M1 5l4-4" />
              </svg>
              Previous
            </button>
            <button onclick="next();"
              class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
              Next
              <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 5h12m0 0L9 1m4 4L9 9" />
              </svg>
            </button>
          </div>
          <div id="pin"></div>
        </div>
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

<script type="text/javascript">
let pagination_index = 0;
let result_array = [];
let selected_row = 0;

function displayContent() {
  const resultContainer = document.getElementById('staff-list');

  const htmlContent = result_array.slice(pagination_index * 5, (pagination_index + 1) * 5).map(item => `
      <tr>
      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
        ${item.SID}
      </td>
      <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold">
        ${item.NAME_FIRST + " " + item.NAME_LAST}
      </td>
      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
        <button
          type="button"
          onClick="openPinModal()"
          class="rounded-md disabled:opacity-25 bg-slate-50 px-10 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-200"
        >
          Start
        </button>
      </td>
      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
        <button
          type="button"
          class="rounded-md disabled:opacity-25 bg-red-200 px-10 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-red-300"
        >
          Stop
        </button>
      </td>
      <td class="relative whitespace-nowrap py-4 text-sm font-medium ">
        <button
          type="button"
          class="rounded-md bg-slate-100 px-10 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
        >
          Request
        </button>
      </td>
      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
        <div class="flex items-center h-5 justify-center">
          <input
            id="helper-radio"
            aria-describedby="helper-radio-text"
            type="radio"
            value=""
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
          />
        </div>
      </td>
    </tr>
      `).join('');
  resultContainer.innerHTML = htmlContent;
}

$(document).ready(function() {
  $.ajax({
    type: "GET",
    url: 'get_staff_data.php',
    success: function(response) {
      // var jsonData = JSON.parse(response);
      // console.log(response);
      let i = 0;
      let indexStart;
      let indexEnd;
      while (i < response.length) {
        if (response[i] == '{') {
          indexStart = i;
        }
        if (response[i] == '}') {
          indexEnd = i;
          const text = JSON.parse(response.slice(indexStart, indexEnd + 1));
          result_array.push(text);
        }
        i++;
      }

      // console.log(result_array);
      displayContent();
    }
  });
})

function displayPinModal() {

}


function previous() {
  if (pagination_index > 0) pagination_index--;
  displayContent();
}

function next() {
  if (pagination_index < result_array.length) pagination_index++;
  displayContent();
}

function openPinModal() {

}
</script>

</html>