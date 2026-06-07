<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'hero_tagline',
        'hero_title',
        'hero_description',
        'contact_whatsapp',
        'price_startup',
        'price_professional',
        'price_enterprise',
        'instagram_url',
        'dribbble_url',
        'behance_url',
        'linkedin_url',
    ];

    /**
     * Get settings or create one with default values if empty.
     */
    public static function getSettings()
    {
        $settings = self::first();
        if (!$settings) {
            $settings = self::create([
                'site_name' => 'Logofolio',
                'hero_tagline' => 'Creative Branding Studio',
                'hero_title' => 'Desain Logo yang <br><span class="text-gradient">Mendefinisikan</span> Bisnis Anda.',
                'hero_description' => 'Kami tidak sekadar menggambar ikon. Kami merancang identitas visual yang strategis, orisinal, dan tak lekang oleh waktu untuk membedakan brand Anda dari kompetitor.',
                'contact_whatsapp' => '628123456789',
                'price_startup' => 'Rp 1,5 Jt',
                'price_professional' => 'Rp 3,5 Jt',
                'price_enterprise' => 'Rp 8,5 Jt',
                'instagram_url' => '#',
                'dribbble_url' => '#',
                'behance_url' => '#',
                'linkedin_url' => '#',
            ]);
        }
        return $settings;
    }
}
