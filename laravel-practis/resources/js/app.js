import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let companySelect = document.getElementById('company_id');
companySelect.addEventListener('change', function () {
    let company_id = this.value;

    if (!company_id) {
        return;
    }

    axios.get(`/api/companies/${company_id}/sections/`).then((response) => {
        let sections = response.data;
        let sectionSelect = document.getElementById('section_id');
        sectionSelect.innerHTML = '';

        let option = document.createElement('option');
        option.value = '';
        option.text = '部署を選択';
        sectionSelect.appendChild(option);

        sections.forEach((section) => {
            let option = document.createElement('option');
            option.value = section.id;
            option.text = section.name;
            if (sectionSelect.dataset.default === section.id.toString()) {
                option.selected = true;
            }
            sectionSelect.appendChild(option);
        });
    });
});

companySelect.dispatchEvent(new Event('change'));
