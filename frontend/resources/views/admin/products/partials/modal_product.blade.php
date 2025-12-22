{{-- 1. KHU VỰC MODAL FORM --}}
<div id="product-form-container" style="display: none;">
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            overflow: auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 95%;
            max-width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .form-grid-layout {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-grid-layout .input-text,
        .form-grid-layout .select-box,
        .form-grid-layout .text-area {
            width: 100%;
            box-sizing: border-box;
            height: 40px;
            padding: 8px 15px;
        }

        .form-grid-layout .text-area {
            height: 120px;
        }

        .form-grid-full-span {
            grid-column: 1 / -1;
        }

        .custom-file-upload-wrapper {
            display: flex;
            align-items: center;
            border: 1px solid #adb5bd;
            border-radius: 3px;
            height: 40px;
            overflow: hidden;
            cursor: pointer;
        }

        .custom-file-text {
            flex-grow: 1;
            padding: 0 10px;
            color: #6c757d;
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .custom-file-button {
            background-color: #adb5bd;
            color: white;
            padding: 0 15px;
            height: 100%;
            display: flex;
            align-items: center;
            font-weight: 700;
        }

        .modal-footer-flex {
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
    </style>

    <div class="modal-overlay">
        <div class="modal-content">
            <div class="dash__pad-2">
                <h1 class="dash__h1 u-s-m-b-14 u-c-secondary" id="form-title">THÊM SẢN PHẨM MỚI</h1>
                <form class="l-f-o__form" id="product-form" enctype="multipart/form-data">
                    <input type="hidden" name="_method" id="form-method" value="POST">
                    <div class="form-grid-layout">
                        <div class="u-s-m-b-30">
                            <label class="gl-label">TÊN SẢN PHẨM *</label>
                            <input class="input-text" type="text" id="product-name" name="name" required>
                        </div>
                        <div class="u-s-m-b-30">
                            <label class="gl-label">GIÁ (VND) *</label>
                            <input class="input-text" type="number" id="product-price" name="price" required>
                        </div>
                        <div class="u-s-m-b-30">
                            <label class="gl-label">DANH MỤC *</label>
                            <select class="select-box" id="product-category" name="category_id" required>
                                <option value="" disabled selected>Chọn danh mục</option>
                            </select>
                        </div>
                        <div class="u-s-m-b-30">
                            <label class="gl-label">SỐ LƯỢNG *</label>
                            <input class="input-text" type="number" id="product-stock" name="quantity" required>
                        </div>
                        <div class="u-s-m-b-30 form-grid-full-span">
                            <div class="form-grid-layout">
                                <div>
                                    <label class="gl-label">ẢNH CHÍNH</label>
                                    <input type="file" id="product-image-file" name="image_file" accept="image/*"
                                        style="display: none;">
                                    <label for="product-image-file" class="custom-file-upload-wrapper">
                                        <span class="custom-file-text" id="image-file-name">Chưa chọn tệp</span>
                                        <span class="custom-file-button">Chọn tệp</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="gl-label">MODEL 3D (.GLB)</label>
                                    <input type="file" id="product-model-file" name="model_file" accept=".glb,.gltf"
                                        style="display: none;">
                                    <label for="product-model-file" class="custom-file-upload-wrapper">
                                        <span class="custom-file-text" id="model-file-name">Chưa chọn tệp</span>
                                        <span class="custom-file-button">Chọn tệp</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="u-s-m-b-30 form-grid-full-span">
                            <label class="gl-label">MÔ TẢ *</label>
                            <textarea class="text-area" id="product-description" name="description" required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer-flex">
                <button class="btn btn--e-dark-outline" type="button" onclick="hideForm()">Quay lại</button>
                <button class="btn btn--e-brand-b-2" type="button" id="submit-form-btn-modal">
                    <span id="form-submit-text">THÊM SẢN PHẨM</span>
                </button>
            </div>
        </div>
    </div>
</div>
