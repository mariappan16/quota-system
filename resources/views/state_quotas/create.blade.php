@extends('layouts.app')
@section('content')
    <form id="state-form" action="{{ route('state-quotas.store') }}" method="POST">
        <h3>State Quota</h3>
        @csrf
        <div class="form-main-container">
            <div class="form-container">
                <label for="sport">Select Sport:</label>
                <select name="sport" id="sport">
                    <option value="">Select Sport</option>
                    @foreach ($sports as $sport)
                        <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-container">
                <label for="gender">Select Gender:</label>
                <select name="gender" id="gender">
                    <option value="">Select Gender</option>
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-container" id="category-section" style="display: none;">
                <label for="category">Select Category:</label>
                <select name="category" id="category">
                    <option value="">Select Category</option>
                </select>
            </div>

            <div class="table" id="quota-table" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>State</th>
                            <th>Category</th>
                            <th>Sport</th>
                            <th>Min Quota</th>
                            <th>Max Quota</th>
                            <th>Reserve Quota</th>
                        </tr>
                    </thead>
                    <tbody id="quota-table-body"></tbody>
                </table>
            </div>

            <div id="overall-quota-info" class="quota-summary" style="display: none;">
                <p>Overall Quota Information</p>
                <p id="min-quota">Min Quota: <span id="min-quota-value"></span></p>
                <p id="max-quota">Max Quota: <span id="max-quota-value"></span></p>
                <p id="reserve-quota" class="overall-reserve-quota">Reserve Quota: <span id="reserve-quota-value"></span>
                </p>
                <p></p>

            </div>

            <div class="error-message" id="error-message" style="display: none;"></div>

            <button type="submit" id="submit" style="display: none;">Submit Form</button>
            <div>

                <div id="error-list"></div>
                <div id="success-message"></div>
    </form>
    <script>
        const sportSelect = document.getElementById('sport');
        const genderSelect = document.getElementById('gender');
        const categorySection = document.getElementById('category-section');
        const categorySelect = document.getElementById('category');
        const submitButton = document.getElementById('submit');
        const quotaTable = document.getElementById('quota-table');
        const inputQuotaFields = document.querySelectorAll('input[type="number"]');

        categorySelect.addEventListener('change', loadStates);
        sportSelect.addEventListener('change', loadCategories);
        genderSelect.addEventListener('change', loadCategories);


        document.getElementById('state-form').addEventListener('submit', function(event) {
            event.preventDefault();
            displayErrorMessage('');
            var errorList = document.getElementById('error-list');
            if (errorList)
                errorList.innerHTML = '';
            validateForm(event);



        });


        function loadStates() {
            const selectedSportId = sportSelect.value;
            const selectedGenderId = genderSelect.value;
            const selectedCategoryId = categorySelect.value;

            if (selectedCategoryId && selectedSportId && selectedCategoryId) {
                const loader = document.getElementById('loader');
                loader.style.display = 'block';
            
                fetch(`/get-states/${selectedSportId}/${selectedGenderId}/${selectedCategoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Overall quota not available for this combination.');
                        }
                        const errorMessageElement = document.getElementById('error-message');
                        errorMessageElement.style.display = 'none';
                        return response.json();
                    })
                    .then(states => {
                        quotaTable.style.display = 'block';
                        loadQuotaTable(states);
                        loader.style.display = 'none';
                        submitButton.style.display = 'block';
                    })
                    .catch(error => {
                        quotaTable.style.display = 'none';
                        loader.style.display = 'none';
                        displayErrorMessage(error.message);
                    });
                    loader.style.display = 'none';
            }
        }


        function loadQuotaTable(states) {
            const tableBody = document.getElementById('quota-table-body');
            tableBody.innerHTML = ''; 

            states.forEach(state => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${state.name}</td>
                    <td>${categorySelect.options[categorySelect.selectedIndex].text}</td>
                    <td>${sportSelect.options[sportSelect.selectedIndex].text}</td>
                    <td><input type="number" name="min_quota_${state.id}" /></td>
                    <td><input type="number" name="max_quota_${state.id}" /></td>
                    <td><input type="number" name="reserve_quota_${state.id}" /></td>
                `;
                tableBody.appendChild(tr);
            });
        }

        function loadCategories() {
            const loader = document.getElementById('loader');
            loader.style.display = 'block';
            const selectedSportId = sportSelect.value;
            const selectedGenderId = genderSelect.value;
            displayErrorMessage('');

            if (selectedSportId && selectedGenderId) {
                
                fetch(`/get-categories/${selectedSportId}/${selectedGenderId}`)
                    .then(response => response.json())
                    .then(data => {
                        categorySection.style.display = 'grid';
                        categorySelect.innerHTML = '<option value="">Select Category</option>';
                        data.forEach(category => {
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            categorySelect.appendChild(option);
                            loader.style.display = 'none';

                        });
                    });
            } else {
                categorySection.style.display = 'none';
                loader.style.display = 'none';
            }
            loader.style.display = 'none';
        }

        function displayErrorMessage(message) {
            const errorMessageElement = document.getElementById('error-message');
            errorMessageElement.textContent = message;
            errorMessageElement.style.display = 'block';
            
        }


        function validateForm(event) {
            const selectedSportId = sportSelect.value;
            const selectedGenderId = genderSelect.value;
            const selectedCategoryId = categorySelect.value;


            if (!selectedSportId || !selectedGenderId || !selectedCategoryId) {
                displayErrorMessage('Please select all the required fields.');
                return false;
            }

            const inputFields = document.querySelectorAll('input[type="number"]');
            let valid = true;

            inputFields.forEach(input => {
                const value = parseFloat(input.value);
                if (isNaN(value) || value < 0) {
                    valid = false;
                    displayErrorMessage('Please enter valid non-negative values for quota fields.');
                    return false;
                }
            });

            if (!valid) {
                return false;
            }


            const minQuota = parseFloat(document.querySelector('input[name^="min_quota_"]').value);
            const maxQuota = parseFloat(document.querySelector('input[name^="max_quota_"]').value);
            const reserveQuota = parseFloat(document.querySelector('input[name^="reserve_quota_"]').value);


            if (minQuota > maxQuota || maxQuota < reserveQuota) {
                displayErrorMessage('Quota values must follow: min < max <= reserve.');
                return false;
            }

            fetch(`/get-overall-quota/${selectedSportId}/${selectedGenderId}/${selectedCategoryId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(overallQuotaData => {
                    document.getElementById('min-quota-value').textContent = overallQuotaData.min_quota;
                    document.getElementById('max-quota-value').textContent = overallQuotaData.max_quota;
                    document.getElementById('reserve-quota-value').textContent = overallQuotaData.reserve_quota;

                    document.getElementById('overall-quota-info').style.display = 'flex';
                    const inputFields = document.querySelectorAll('input[name^="min_quota_"]');
                    let totalMinQuota = 0;
                    let totalMaxQuota = 0;
                    let totalReserveQuota = 0;

                    inputFields.forEach(input => {
                        const stateId = input.name.replace('min_quota_', '');
                        const minQuota = parseFloat(input.value);
                        const maxQuota = parseFloat(document.querySelector(`input[name="max_quota_${stateId}"]`)
                            .value);
                        const reserveQuota = parseFloat(document.querySelector(
                            `input[name="reserve_quota_${stateId}"]`).value);

                        totalMinQuota += minQuota;
                        totalMaxQuota += maxQuota;
                        totalReserveQuota += reserveQuota;
                    });

                    if (totalMinQuota < overallQuotaData.min_quota || totalMaxQuota > overallQuotaData.max_quota ||
                        totalMinQuota > overallQuotaData.max_quota) {
                        displayErrorMessage('Quota values are outside the overall quota bounds.');
                        return false;
                    }

                    if (totalReserveQuota !== overallQuotaData.reserve_quota) {
                        displayErrorMessage('Reserve quota does not match the overall reserve quota.');
                        return false;
                    }

                    var form = event.target;
                    var formData = new FormData(form);

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.message) {
                                document.getElementById('success-message').textContent = data.message;
                                window.location.href = data.redirect;

                            } else if (data.error && data.error.length > 0) {
                                var errorList = document.getElementById('error-list');
                                errorList.innerHTML = '<ul> ' + data.error + '</ul>';
                            }
                        })
                        .catch(error => {
                            console.error('An error occurred:', error);
                        });
                })
                .catch(error => {
                    console.error('An error occurred:', error);
                    return false;
                });
        }
    </script>
@endsection
