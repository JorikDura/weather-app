<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        DB::statement(
            '
            CREATE OR REPLACE FUNCTION check_history_count() RETURNS trigger as
            $check_history_count$
            DECLARE
            counter integer;
            BEGIN
            SELECT count(*) FROM histories WHERE ip = NEW.ip INTO counter;
            IF counter > 5 THEN
            DELETE
            FROM histories
            WHERE id = any (array(SELECT id
                  FROM histories
                  WHERE ip = NEW.ip
                  ORDER BY updated_at
                  LIMIT counter - 5));
            END IF;
            RETURN NULL;
            END;
            $check_history_count$ LANGUAGE plpgsql;
        '
        );
        DB::statement(
            '
        CREATE OR REPLACE TRIGGER check_history_count
        AFTER INSERT
        ON histories
        FOR EACH ROW
        EXECUTE FUNCTION check_history_count();
        '
        );
    }

    public function down(): void
    {
        DB::statement('DROP TRIGGER IF EXISTS check_history_count ON histories;');
        DB::statement('DROP FUNCTION check_history_count();');
    }
};
