import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let sectionSelect = document.getElementById('company_id');
sectionSelect.addEventListener('change', function () {
    let company_id = this.value;

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

sectionSelect.dispatchEvent(new Event('change'));
