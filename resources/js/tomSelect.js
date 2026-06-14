import TomSelect from 'tom-select';

function newTom(id, label) {
    const dropDown = document.getElementById(id);
    const model = dropDown.getAttribute('data-model');
    
    return new TomSelect(`#${id}`, {
        valueField: 'id',
        labelField: label,
        searchField: [label],
        preload: true,
        shouldLoad: () => true,

        load: function(query, callback) {
            // Track what page Tom Select needs to fetch next
            let self = this;
            let page = self.next_page || 1;
            
            // Build the URL pointing directly to your dynamic backend route
            let url = `/genericlist/${model}/${page}?q=${encodeURIComponent(query)}`;

            console.log(`Risk TomSelect is fetching content at: ${url}`);

            fetch(url)
            .then(response => response.json())
            .then(json => {
                if (json.current_page < json.last_page) {
                    self.next_page = json.current_page + 1;
                } else {
                    self.next_page = null;
                }
                callback(json.data);
            }).catch(() => callback());
        }
    });
}

export function initTom() {
    const riskDropdown = document.getElementById('riskDropdown');
    if (riskDropdown) {
        newTom('riskDropdown', 'tag');
    }

    const categoryDropdown = document.getElementById('categoryDropdown');
    if (categoryDropdown) {
        newTom('categoryDropdown', 'name');
    }
}