@extends('layouts.app')
@section('content')
    <form action="{{ route('overall-quotas.store') }}" method="POST">
        <h3>Overall Quota</h3>
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

            <button type="button" id="add-quota-button" style="display: none;">Add Quota</button>

            <!-- Quota Popup (Hidden by default) -->
            <dialog class="dialog-popup" id="quota-popup">
                <div class="form-main-container flex-column">
                    <div class="form-container">
                        <label for="min-quota">Min Quota:</label>
                        <input type="number" name="min_quota" id="min-quota">
                    </div>

                    <div class="form-container">
                        <label for="max-quota">Max Quota:</label>
                        <input type="number" name="max_quota" id="max-quota">
                    </div>

                    <div class="form-container">
                        <label for="reserve-quota">Reserve Quota:</label>
                        <input type="number" name="reserve_quota" id="reserve-quota">
                    </div>
                    <div id="quota-validation-error" style="display: none;">Invalid quota values. Please ensure min, max,
                        and reserve values are valid.</div>

                    <button type="button" id="submit-quota">Submit Quota</button>
                </div>
            </dialog>
            <div id="validation-error" style="display: none;">Please select Sport, Gender, and Category before adding a
                quota.</div>

            <div class="quota-summary" id="quota-summary" style="display: none;">
                <p>Quota Values:</p>
                <p>Min Quota: <span id="summary-min-quota"></span></p>
                <p>Max Quota: <span id="summary-max-quota"></span></p>
                <p>Reserve Quota: <span id="summary-reserve-quota"></span></p>
                <button type="button" id="edit-quota">Edit Quota</button>
            </div>

            <button type="submit" id="submit" style="display: none;">Submit Form</button>
            <div>
                @foreach ($errors->all() as $error)
                    <span id="error-list" class="error">{{ $error }}</span><br>
                @endforeach
    </form>
    <script>
        const sportSelect = document.getElementById('sport');
        const genderSelect = document.getElementById('gender');
        const categorySection = document.getElementById('category-section');
        const categorySelect = document.getElementById('category');
        const addQuotaButton = document.getElementById('add-quota-button');
        const submitButton = document.getElementById('submit');
        const quotaPopup = document.getElementById('quota-popup');
        const validationError = document.getElementById('validation-error');
        const submitQuotaButton = document.getElementById('submit-quota');
        const quotaValidationError = document.getElementById('quota-validation-error');
        const quotaSummary = document.getElementById('quota-summary');
        const summaryMinQuota = document.getElementById('summary-min-quota');
        const summaryMaxQuota = document.getElementById('summary-max-quota');
        const summaryReserveQuota = document.getElementById('summary-reserve-quota');
        const editQuotaButton = document.getElementById('edit-quota');
        const minQuotaInput = document.getElementById('min-quota');
        const maxQuotaInput = document.getElementById('max-quota');
        const reserveQuotaInput = document.getElementById('reserve-quota');

        minQuotaInput.addEventListener('input', hideQuotaValidationError);
        maxQuotaInput.addEventListener('input', hideQuotaValidationError);
        reserveQuotaInput.addEventListener('input', hideQuotaValidationError);

        sportSelect.addEventListener('change', loadCategories);
        genderSelect.addEventListener('change', loadCategories);
        categorySelect.addEventListener('change', toggleAddQuotaButton);
        addQuotaButton.addEventListener('click', openQuotaPopup);
        submitQuotaButton.addEventListener('click', submitQuota);
        editQuotaButton.addEventListener('click', editQuota);

        function toggleAddQuotaButton() {
            quotaSummary.style.display = 'none';
            submitButton.style.display = 'none';
            summaryMinQuota.textContent = '';
            summaryMaxQuota.textContent = '';
            summaryReserveQuota.textContent = '';
            minQuotaInput.value = '';
            maxQuotaInput.value = '';
            reserveQuotaInput.value = '';


            if (sportSelect.value && genderSelect.value && categorySelect.value) {
                addQuotaButton.style.display = 'block';
            } else {
                addQuotaButton.style.display = 'none';
            }
        }

        function hideQuotaValidationError() {
            quotaValidationError.style.display = 'none';
        }

        function submitQuota() {
            const minQuota = parseFloat(document.getElementById('min-quota').value);
            const maxQuota = parseFloat(document.getElementById('max-quota').value);
            const reserveQuota = parseFloat(document.getElementById('reserve-quota').value);

            if (isValidQuota(minQuota, maxQuota, reserveQuota)) {
                summaryMinQuota.textContent = minQuota;
                summaryMaxQuota.textContent = maxQuota;
                summaryReserveQuota.textContent = reserveQuota;
                quotaSummary.style.display = 'flex';
                submitButton.style.display = 'block';
                addQuotaButton.style.display = 'none';
                quotaPopup.close();
                quotaValidationError.style.display = 'none';
            } else if (minQuota < 0) {
                quotaValidationError.textContent = 'Minimum quota must be a non-negative value.';
            } else if (maxQuota < minQuota) {
                quotaValidationError.textContent = 'Maximum quota must be greater than or equal to minimum quota.';
            } else if (reserveQuota < 0) {
                quotaValidationError.textContent = 'Reserve quota must be a non-negative value.';
            } else if (reserveQuota > maxQuota) {
                quotaValidationError.textContent = 'Reserve quota must be less than a max quota.';
            } else {
                quotaValidationError.textContent = 'Invalid quota values.';
            }
            quotaValidationError.style.display = 'block';
        }

        function editQuota() {
            quotaSummary.style.display = 'none';
            submitButton.style.display = 'none';
            addQuotaButton.style.display = 'block';
            quotaPopup.showModal();
            quotaValidationError.style.display = 'none';

        }

        function isValidQuota(minQuota, maxQuota, reserveQuota) {
            return minQuota >= 0 && maxQuota >= minQuota && reserveQuota >= 0 && reserveQuota <= maxQuota;
        }

        function openQuotaPopup() {
            if (sportSelect.value && genderSelect.value && categorySelect.value) {
                quotaPopup.showModal();
                validationError.style.display = 'none';
            } else {
                validationError.style.display = 'block';
            }
        };

        function loadCategories() {
            const loader = document.getElementById('loader');
            loader.style.display = 'block';
            const selectedSportId = sportSelect.value;
            const selectedGenderId = genderSelect.value;
            quotaSummary.style.display = 'none';
            submitButton.style.display = 'none';
            summaryMinQuota.textContent = '';
            summaryMaxQuota.textContent = '';
            summaryReserveQuota.textContent = '';
            minQuotaInput.value = '';
            maxQuotaInput.value = '';
            reserveQuotaInput.value = '';
            if (selectedSportId && selectedGenderId) {
                fetch(`/get-categories/${selectedSportId}/${selectedGenderId}`)
                    .then(response => response.json())
                    .then(data => {
                        categorySelect.innerHTML = '<option value="">Select Category</option>';
                        data.forEach(category => {
                            categorySection.style.display = 'grid';
                            const option = document.createElement('option');
                            option.value = category.id;
                            option.textContent = category.name;
                            categorySelect.appendChild(option);
                            loader.style.display = 'none';
                        });
                    });
            } else {
                categorySection.style.display = 'none';
            }
            loader.style.display = 'none';
        }
    </script>
@endsection
