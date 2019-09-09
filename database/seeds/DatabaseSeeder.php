<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KursKodeseed::class,
            Kppseed::class,
            KppJenisseed::class,
            Treatyseed::class,
            TreatyInfoseed::class,
            TreatyJenisseed::class,
            Putusanseed::class,
            PutusanCatseed::class,
            Aturanseed::class,
            AturanTopikseed::class,
            AturanInfoseed::class,
            AturanJenisseed::class,
            ContentSeed::class,
            ContentCatSeed::class,
            TagSeed::class,
            UserSeed::class]
        );
    }
}
