<style>
    .cat-modal-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6); z-index: 1100;
        display: flex; justify-content: center; align-items: center;
    }
    .cat-modal-content {
        background: #fff; padding: 30px; border-radius: 12px;
        width: 500px; box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
</style>

<div id="category-modal-container" style="display: none;">
    <div class="cat-modal-overlay">
        <div class="cat-modal-content">
            <h1 class="dash__h1 u-s-m-b-20" id="category-form-title">THÊM DANH MỤC</h1>

            <form id="category-form">
                <input type="hidden" id="category-id">
                <input type="hidden" id="category-method" value="POST">

                <div class="u-s-m-b-20">
                    <label class="gl-label" for="category-name">TÊN DANH MỤC *</label>
                    <input class="input-text input-text--primary-style" type="text"
                           id="category-name" oninput="generateSlug(this.value)" placeholder="Nhập tên danh mục..." required>
                </div>

                <div class="u-s-m-b-20">
                    <label class="gl-label" for="category-slug">SLUG</label>
                    <input class="input-text input-text--primary-style" type="text"
                           id="category-slug" placeholder="Ví dụ: do-noi-that" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn--e-brand-b-2 u-s-m-r-10" type="button"
                            onclick="handleCategorySubmit()">LƯU LẠI</button>
                    <button class="btn btn--e-dark-outline" type="button"
                            onclick="hideCategoryModal()">HỦY</button>
                </div>
            </form>
        </div>
    </div>
</div>
