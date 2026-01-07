<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductAdminController extends Controller
{
    public function handleLocalUpload(Request $request)
    {
        $productId = $request->product_id;
        $results = ['images' => [], 'model' => null];

        // 1. Xử lý Model 3D (Dùng chung cho cả thêm/sửa)
        if ($request->hasFile('model_file')) {
            $dir = "uploads/model3d/{$productId}";
            $fullPath = public_path($dir);
            if (!file_exists($fullPath)) mkdir($fullPath, 0777, true);

            array_map('unlink', glob("$fullPath/*.glb")); // Xóa model cũ
            $file = $request->file('model_file');
            $fileName = $file->getClientOriginalName();
            $file->move($fullPath, $fileName);
            $results['model'] = "{$dir}/{$fileName}";
        }

        // 2. Xử lý Hình ảnh theo vị trí (Index)
        if ($request->hasFile('images')) {
            $dir = "uploads/product_images/{$productId}";
            $fullPath = public_path($dir);
            if (!file_exists($fullPath)) mkdir($fullPath, 0777, true);

            $indices = $request->input('image_indices', []);
            foreach ($request->file('images') as $key => $file) {
                $realIndex = (int)$indices[$key];

                // Xóa file cũ tại vị trí này để ghi đè (ví dụ xóa 1.png trước khi lưu 1.jpg mới)
                $oldFiles = glob("$fullPath/" . ($realIndex + 1) . ".*");
                foreach ($oldFiles as $old) if (is_file($old)) unlink($old);

                $fileName = ($realIndex + 1) . '.' . $file->getClientOriginalExtension();
                $file->move($fullPath, $fileName);

                $results['images'][] = [
                    'url' => "{$dir}/{$fileName}",
                    'index' => $realIndex,
                    'is_primary' => ($realIndex === 0 ? 1 : 0)
                ];
            }
        }
        return response()->json($results);
    }
    /**
     * Xử lý upload file 3D Model
     */
    private function uploadModelFile(Request $request, $productId)
    {
        if (!$request->hasFile('model_file')) return null;

        $relativeDir = "uploads/model3d/{$productId}";
        $fullPath = public_path($relativeDir);

        if (!file_exists($fullPath)) mkdir($fullPath, 0777, true);

        // Dọn dẹp file .glb cũ để ghi đè
        array_map('unlink', glob("$fullPath/*.glb"));

        $file = $request->file('model_file');
        $fileName = $file->getClientOriginalName();
        $file->move($fullPath, $fileName);

        return "{$relativeDir}/{$fileName}";
    }

    /**
     * Xử lý upload danh sách hình ảnh theo index
     */
    private function uploadImageFiles(Request $request, $productId)
    {
        if (!$request->hasFile('images')) return [];

        $results = [];
        $relativeDir = "uploads/product_images/{$productId}";
        $fullPath = public_path($relativeDir);

        if (!file_exists($fullPath)) mkdir($fullPath, 0777, true);

        $indices = $request->input('image_indices', []);

        foreach ($request->file('images') as $key => $file) {
            $realIndex = $indices[$key];

            // Tìm và xóa ảnh cũ tại vị trí index này (1.png, 1.jpg...)
            $oldFiles = glob("$fullPath/" . ($realIndex + 1) . ".*");
            foreach ($oldFiles as $old) unlink($old);

            $fileName = ($realIndex + 1) . '.' . $file->getClientOriginalExtension();
            $file->move($fullPath, $fileName);

            $results[] = [
                'url' => "{$relativeDir}/{$fileName}",
                'index' => (int)$realIndex,
                'is_primary' => ($realIndex == 0 ? 1 : 0)
            ];
        }
        return $results;
    }
}
