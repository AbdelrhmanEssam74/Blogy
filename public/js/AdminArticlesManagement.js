/*
* send request to approve article
* @param {int} articleId
* @param {string} route
*/
function updateArticleStatus(articleId , route) {
    const form = document.getElementById('update-form');
    form.action = route;
    form.submit();
}

/*
 * Filter articles
 */

// function applyFilters() {
//     // get articles status
//     const status = document.getElementById('statusFilter').value;
//     // get articles category
//     const category_id = document.getElementById('categoryFilter').value;
//     // get article writer
//     const writer_id = document.getElementById('writerFilter').value;
//     console.log( status, category_id, writer_id);
//     // get the form and submit it with the new values and the route
//     const form = document.getElementById('filter-form');
//     form.action = `/admin/articles/filter?status=${status}&category_id=${category_id}&writer_id=${writer_id}`;
//
//     console.log(form)
//     form.submit();
// }
