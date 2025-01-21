<?php

namespace App\Filament\Resources\ProjectAssignmentsResource\Pages;

use App\Filament\Resources\ProjectAssignmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectAssignments extends EditRecord
{
    protected static string $resource = ProjectAssignmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
