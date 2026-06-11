let page = 1;
let maxPage;
let showing = ['excuse', 'Excuses'];

async function getList(model, page=1) {
    const response = await fetch(`/genericlist/${model}/${page}`);
    return await response.json();
}

async function showList(model, page=1, columns, showColumns) {
    const listDiv = document.getElementById('list');
    const pageSpan = document.getElementById('page');
    const totalPagesSpan = document.getElementById('totalPages');
    const showingP = document.getElementById('showing');

    if (listDiv && pageSpan && totalPagesSpan && showingP) {
        showingP.innerText = showing[1];
        const list = await getList(model, page);
        if (list && list.data) {
            let html = '';
            for (const object of list.data) {

                let info;

                html += `<div class='mt-2'><a href=detail/${model}/${object.id}>`;
                
                for (const [i, column] of columns.entries()) {

                    if (column.includes('.')) {
                        const parts = column.split('.');
                        const relation = parts[0];
                        const field = parts[1];

                        info = object[relation]?.[field] ?? 'N/A';
                    } else {
                        info = object[column] ?? 'N/A';
                    }
    
                    html += `<p>${showColumns[i]}: ${info}</p>`
                }
                html += '</a></div>';
            }
            listDiv.innerHTML = html;
            pageSpan.innerText = list.current_page || list.page;
            maxPage = list.last_page || list.total_pages;
            totalPagesSpan.innerText = maxPage;
        } else {
            listDiv.innerHTML = '<p>Sorry, no objects found</p>';
            pageSpan.innerText = '0';
            maxPage = 1;
            totalPagesSpan.innerText = '0';
        }
    }
}

function excuse() {
    page = 1;
    showing = ['excuse', 'Excuses'];
    showList("excuse", page, [
        'text', 
        'category.name', 
        'risk.tag', 
        'believability_rate', 
        'chaos_score'
    ], [
        'Excuse',
        'Category',
        'Risk',
        'Believability Rate',
        'Chaos Score'
    ]);
}

function risk() {
    page = 1;
    showing = ['risk', 'Risks'];
    showList("risk", page, [
        'tag', 
        'severity_score'
    ], [
        'Risk',
        'Severity Score'
    ]);
}

function category() {
    page = 1;
    showing = ['category', 'Categories'];
    showList("category", page, [
        'name'
    ], [
        'Category'
    ]);
}

export function initList() {
    const excuseBtn = document.getElementById('excuseBtn');
    if (excuseBtn) {
        excuseBtn.addEventListener('click', excuse);
    }
    const riskBtn = document.getElementById('riskBtn');
    if (riskBtn) {
        riskBtn.addEventListener('click', risk);
    }
    const categBtn = document.getElementById('categBtn');
    if (categBtn) {
        categBtn.addEventListener('click', category);
    }
    excuse();

    const LpBtn = document.getElementById('LpBtn');
    if (LpBtn) {
        LpBtn.addEventListener('click', () => {
            if (page > 1) {
                page--;
                window[showing[0]]();
            }
        });
    }

    const RpBtn = document.getElementById('RpBtn');
    if (RpBtn) {
        RpBtn.addEventListener('click', () => {
            if (page < 1) {
                page++;
                window[showing[0]]();
            }
        });
    }
}