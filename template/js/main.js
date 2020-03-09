window.onload = function () {
    let sort = 'desc';
    document.getElementById('sort-col').addEventListener('click', (e) => {
        if (!e.target instanceof HTMLElement || !e.target.classList.contains('cross')) {
            return;
        }
        sort = sort === 'desc' ? 'asc' : 'desc';

        axios.post(`table/${e.target.dataset.id}/${sort}`)
            .then(function (response) {
                document.querySelector('.table-wrapper').innerHTML = response.data;
                bindDeleteButton();
            })
    });
    bindDeleteButton();
};

function bindDeleteButton()
{
    document.querySelectorAll('.bt-del').forEach((button) => {
        button.addEventListener('click', (e) => {
            if (!e.target instanceof HTMLElement) {
                return;
            }

            document.getElementById(`row-${e.target.dataset.id}`).remove();
            axios.post(`request/${e.target.dataset.id}`)
        });
    });
}
