document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchInput");
    const searchMessage = document.getElementById("searchMessage");
    const searchResults = document.getElementById("searchResults");

    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const searchValue = searchInput.value.trim();

        if (searchValue === "") {
            searchMessage.textContent = "請輸入搜尋關鍵字！";
            searchMessage.style.color = "red";
            return;
        }

        searchMessage.textContent = ""; // 清空提示訊息

        // 發送 AJAX 請求
        fetch(`search_results.php?search_name=${encodeURIComponent(searchValue)}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    displayResults(data.data);
                } else {
                    searchMessage.textContent = data.message;
                    searchMessage.style.color = "red";
                }
            })
            .catch(error => {
                searchMessage.textContent = "發生錯誤，請稍後再試！";
                searchMessage.style.color = "red";
            });
    });

    function displayResults(results) {
        searchResults.innerHTML = ""; // 清空結果區域
        results.forEach(product => {
            const card = document.createElement("div");
            card.className = "col-md-3";

            card.innerHTML = `
                <div class="card card-trans mt-3">
                    <img src="./product_img/${product.img_file}" class="card-img-top" alt="${product.p_name}" title="${product.p_name}">
                    <div class="card-body">
                        <h5 class="card-title text-ellipsis">${product.p_name}</h5>
                        <p class="card-text">NT${product.p_price}</p>
                        <a href="#" class="btn btn-primary">更多資訊</a>
                        <a href="#" class="btn btn-success">放購物車</a>
                    </div>
                </div>
            `;
            searchResults.appendChild(card);
        });
    }
});
