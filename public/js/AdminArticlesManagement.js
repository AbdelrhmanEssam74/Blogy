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
