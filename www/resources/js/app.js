document.addEventListener('DOMContentLoaded', function () {
    loadProducts();

    document.querySelector('.filters-form').addEventListener('submit', function (e) {
        e.preventDefault();
        loadProducts();
    });

    document.querySelector('.filters-form .reset-btn').addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.filters-form input, .filters-form select').forEach(input => {
            if (input.type === 'checkbox') {
                input.checked = false;
            } else {
                input.value = '';
            }
        });
        loadProducts();
    });
});

async function loadProducts(page = 1) {
    const form = document.querySelector('.filters-form');
    const formData = new FormData(form);
    const params = new URLSearchParams();

    params.append('page', page);

    for (const [key, value] of formData.entries()) {
        if (value) {
            params.append(key, value);
        }
    }

    try {
        const response = await fetch(`/api/products?${params.toString()}`);
        const data = await response.json();

        const container = document.getElementById('products-container');
        const paginationContainer = document.getElementById('pagination-container');

        container.innerHTML = '';
        paginationContainer.innerHTML = '';

        if (data.data && data.data.length > 0) {
            renderProducts(container, data.data);
            renderPagination(paginationContainer, data.links);
        } else {
            container.innerHTML = '<p>Продукты не найдены.</p>';
        }
    } catch (error) {
        console.error('Ошибка загрузки продуктов:', error);
        alert('Ошибка загрузки продуктов:');
    }
}

function renderProducts(container, products) {
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'product';
        productDiv.innerHTML = `
            <h3>${product.name}</h3>
            <p>Категория: ${product.category ? product.category.name : 'Без категории'}</p>
            <p>Цена: ${product.price}</p>
            <p>Рейтинг: ${product.rating}</p>
        `;

        container.appendChild(productDiv);
    });
}

function renderPagination(paginationContainer, links) {
    if (!links) {
        return;
    }

    links.forEach(link => {
        if (link.url) {
            const pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.innerHTML = link.label;
            pageLink.onclick = function (e) {
                e.preventDefault();
                const page = new URL(link.url).searchParams.get('page');
                loadProducts(page);
            };

            paginationContainer.appendChild(pageLink);
        } else if (link.label === '&laquo; Previous') {
            const span = document.createElement('span');
            span.innerHTML = 'Предыдущая';

            paginationContainer.appendChild(span);
        } else if (link.label === 'Next &raquo;') {
            const span = document.createElement('span');
            span.innerHTML = 'Следующая';

            paginationContainer.appendChild(span);
        } else {
            const span = document.createElement('span');
            span.innerHTML = link.label;

            paginationContainer.appendChild(span);
        }
    });
}
