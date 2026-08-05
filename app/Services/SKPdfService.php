<?php

namespace App\Services;

use App\Models\Pengajuan;
use App\Models\Persyaratan;
use App\Models\PengajuanFile;
use setasign\Fpdi\Fpdi;

class SKPdfService
{
    /**
     * Generate SK PDF with pas photo embedded
     */
    public function generateSkWithPhoto(Pengajuan $pengajuan, string $sourceFilePath): string
    {
        // Get the pas photo file from Persyaratan with id = 3 or nama = "Pas Foto"
        $pasFoto = $this->getPasFotoFile($pengajuan);

        // Create temporary output path
        $outputPath = storage_path('app/public/sk-files/' . pathinfo($sourceFilePath, PATHINFO_FILENAME) . '_with_photo.pdf');

        // Ensure directory exists
        $dir = dirname($outputPath);
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        // Initialize FPDI
        $pdf = new Fpdi();

        // Get page count from source PDF
        $pageCount = $pdf->setSourceFile($sourceFilePath);

        // Import all pages
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Add a page
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

            // Use the template
            $pdf->useTemplate($templateId);

            // Add pas photo to the first page only
            if ($pageNo === 1 && $pasFoto && file_exists($pasFoto)) {
                $pdf->Image(
                    $pasFoto,
                    88,   // X position
                    230,  // Y position
                    36,   // Width
                    48    // Height
                );
            }
        }

        // Output to file
        $pdf->Output('F', $outputPath);

        return $outputPath;
    }

    /**
     * Get the pas foto file path from PengajuanFile
     */
    private function getPasFotoFile(Pengajuan $pengajuan): ?string
    {
        // Find Persyaratan with id = 3 or nama = "Pas Foto"
        $persyaratan = Persyaratan::where('id', 3)
            ->orWhere('nama', 'Pas Foto')
            ->first();

        if (!$persyaratan) {
            return null;
        }

        // Find the uploaded file for this pengajuan with that persyaratan
        $pengajuanFile = PengajuanFile::where('pengajuan_id', $pengajuan->id)
            ->where('persyaratan_id', $persyaratan->id)
            ->first();

        if (!$pengajuanFile || !$pengajuanFile->file) {
            return null;
        }

        // Build the full path
        $fullPath = storage_path('app/public/' . $pengajuanFile->file);

        if (!file_exists($fullPath)) {
            return null;
        }

        return $fullPath;
    }
}
