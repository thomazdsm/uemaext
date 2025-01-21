<?php

namespace App\Filament\Resources;

use App\Enums\ProjectUserRole;
use App\Enums\UserRole;
use App\Filament\Resources\ProjectAssignmentsResource\Pages;
use App\Filament\Resources\ProjectAssignmentsResource\RelationManagers;
use App\Models\ProjectAssignments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectAssignmentsResource extends Resource
{
    protected static ?string $model = ProjectAssignments::class;

    public static function getModelLabel(): string
    {
        return __('Assignments');
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\Select::make('role')
                    ->options(
                        collect(ProjectUserRole::cases())
                            ->mapWithKeys(fn(ProjectUserRole $role) => [$role->value => $role->getLabel()])
                            ->toArray()
                    )
                    ->required()
                    ->default(ProjectUserRole::MEMBER->value),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->formatStateUsing(function ($state) {
                        if (!$state) {
                            return '-';
                        }
                        return $state->getLabel();
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectAssignments::route('/'),
            'create' => Pages\CreateProjectAssignments::route('/create'),
            'edit' => Pages\EditProjectAssignments::route('/{record}/edit'),
        ];
    }
}
