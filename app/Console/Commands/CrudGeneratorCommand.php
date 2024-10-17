<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CrudGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create CRUD files: model, migration, controller, store request, update request, view.';

    public function handle()
    {
        $this->info('Creating magic... 🪄');

        $this->createModel();
        $this->createController();
        $this->createRequests();
        $this->modifyMigration();
        $this->modifyRepository();
        $this->createTest();
        $this->createFactory();
        $this->createViews();
        $this->addRoutes();
        $this->addSidebarMenu();

        $this->comment('Playground created successfully');
    }

    protected function createModel()
    {
        $name = $this->argument('name');
        $this->call('make:model', ['name' => $name, '-m' => true]);

        $modelPath = app_path("Models/{$name}.php");

        $modelContent = "<?php\n\n";
        $modelContent .= "namespace App\Models;\n\n";
        $modelContent .= "use Illuminate\Database\Eloquent\Factories\HasFactory;\n";
        $modelContent .= "use Illuminate\Database\Eloquent\Model;\n";
        $modelContent .= "use Illuminate\Database\Eloquent\SoftDeletes;\n";
        $modelContent .= "use App\Traits\UUID;\n\n";
        $modelContent .= "class {$name} extends Model\n";
        $modelContent .= "{\n";
        $modelContent .= "    use HasFactory, UUID, SoftDeletes;\n\n";
        $modelContent .= "    protected \$fillable = [\n";
        $modelContent .= "        // Add your columns here\n";
        $modelContent .= "    ];\n";
        $modelContent .= "}\n";

        file_put_contents($modelPath, $modelContent);
    }

    protected function createRequests()
    {
        $name = $this->argument('name');
        $this->call('make:request', ['name' => "Store{$name}Request"]);
        $this->call('make:request', ['name' => "Update{$name}Request"]);

        $storeRequestPath = app_path("Http/Requests/Store{$name}Request.php");
        $storeRequestContent = "<?php\n\n";
        $storeRequestContent .= "namespace App\Http\Requests;\n\n";
        $storeRequestContent .= "use Illuminate\Foundation\Http\FormRequest;\n\n";
        $storeRequestContent .= "class Store{$name}Request extends FormRequest\n";
        $storeRequestContent .= "{\n";
        $storeRequestContent .= "    /**\n";
        $storeRequestContent .= "     * Get the validation rules that apply to the request.\n";
        $storeRequestContent .= "     *\n";
        $storeRequestContent .= "     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>\n";
        $storeRequestContent .= "     */\n";
        $storeRequestContent .= "    public function rules()\n";
        $storeRequestContent .= "    {\n";
        $storeRequestContent .= "        return [\n";
        $storeRequestContent .= "            // Add your validation rules here\n";
        $storeRequestContent .= "        ];\n";
        $storeRequestContent .= "    }\n";
        $storeRequestContent .= "  public function attributes()\n";
        $storeRequestContent .= "    {\n";
        $storeRequestContent .= "        return [\n";
        $storeRequestContent .= "            // Add your attributes here\n";
        $storeRequestContent .= "        ];\n";
        $storeRequestContent .= "    }\n";
        $storeRequestContent .= "  public function messages()\n";
        $storeRequestContent .= "    {\n";
        $storeRequestContent .= "        return [\n";
        $storeRequestContent .= "            // Add your messages here\n";
        $storeRequestContent .= "        ];\n";
        $storeRequestContent .= "    }\n";
        $storeRequestContent .= "}\n";

        file_put_contents($storeRequestPath, $storeRequestContent);

        $updateRequestPath = app_path("Http/Requests/Update{$name}Request.php");
        $updateRequestContent = "<?php\n\n";
        $updateRequestContent .= "namespace App\Http\Requests;\n\n";
        $updateRequestContent .= "use Illuminate\Foundation\Http\FormRequest;\n\n";
        $updateRequestContent .= "class Update{$name}Request extends FormRequest\n";
        $updateRequestContent .= "{\n";
        $updateRequestContent .= "    /**\n";
        $updateRequestContent .= "     * Get the validation rules that apply to the request.\n";
        $updateRequestContent .= "     *\n";
        $updateRequestContent .= "     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>\n";
        $updateRequestContent .= "     */\n";
        $updateRequestContent .= "    public function rules()\n";
        $updateRequestContent .= "    {\n";
        $updateRequestContent .= "        return [\n";
        $updateRequestContent .= "            // Add your validation rules here\n";
        $updateRequestContent .= "        ];\n";
        $updateRequestContent .= "    }\n";
        $updateRequestContent .= "  public function attributes()\n";
        $updateRequestContent .= "    {\n";
        $updateRequestContent .= "        return [\n";
        $updateRequestContent .= "            // Add your attributes here\n";
        $updateRequestContent .= "        ];\n";
        $updateRequestContent .= "    }\n";
        $updateRequestContent .= "  public function messages()\n";
        $updateRequestContent .= "    {\n";
        $updateRequestContent .= "        return [\n";
        $updateRequestContent .= "            // Add your messages here\n";
        $updateRequestContent .= "        ];\n";
        $updateRequestContent .= "    }\n";
        $updateRequestContent .= "}\n";

        file_put_contents($updateRequestPath, $updateRequestContent);
    }

    protected function createController()
    {
        $name = $this->argument('name');

        $names = Str::plural(Str::snake($name));

        $this->call('make:controller', ['name' => "Web/Admin/{$name}Controller", '--resource' => true]);

        $controllerPath = app_path("Http/Controllers/Web/Admin/{$name}Controller.php");

        $controllerContent = "<?php\n\n";
        $controllerContent .= "namespace App\Http\Controllers\Web\Admin;\n\n";
        $controllerContent .= "use App\Http\Controllers\Controller;\n";
        $controllerContent .= "use App\Http\Requests\\Store{$name}Request;\n";
        $controllerContent .= "use App\Http\Requests\\Update{$name}Request;\n";
        $controllerContent .= "use App\Interfaces\\{$name}RepositoryInterface;\n";
        $controllerContent .= "use RealRashid\SweetAlert\Facades\Alert as Swal;\n";
        $controllerContent .= "use Illuminate\Http\Request;\n";
        $controllerContent .= "class {$name}Controller extends Controller\n";
        $controllerContent .= "{\n";
        $controllerContent .= "    protected \${$name}Repository;\n\n";
        $controllerContent .= "    public function __construct({$name}RepositoryInterface \${$name}Repository)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \$this->{$name}Repository = \${$name}Repository;\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function index(Request \$request)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "         \${$names} = \$this->{$name}Repository->getAll{$name}();\n";
        $controllerContent .= "         return view('pages.admin.{$name}.index', compact('{$names}'));\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function create()\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "       return view('pages.admin.{$name}.create');\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function store(Store{$name}Request \$request)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \$data = \$request->validated();\n";
        $controllerContent .= "        \$this->{$name}Repository->create{$name}(\$data);\n";
        $controllerContent .= "        Swal::toast('{$name} created successfully!', 'success')->timerProgressBar();\n";
        $controllerContent .= "        return redirect()->route('{$name}.index');\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function show(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "      \${$name} = \$this->{$name}Repository->get{$name}ById(\$id);\n";
        $controllerContent .= "      return view('pages.admin.{$name}.show', compact('{$name}'));\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function edit(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "      \${$name} = \$this->{$name}Repository->get{$name}ById(\$id);\n";
        $controllerContent .= "      return view('pages.admin.{$name}.edit', compact('{$name}'));\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function update(Update{$name}Request \$request, \$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "        \$data = \$request->validated();\n";
        $controllerContent .= "        \$this->{$name}Repository->update{$name}(\$data, \$id);\n";
        $controllerContent .= "        Swal::toast('{$name} updated successfully!', 'success')->timerProgressBar();\n";
        $controllerContent .= "        return redirect()->route('{$name}.index');\n";
        $controllerContent .= "    }\n\n";
        $controllerContent .= "    public function destroy(\$id)\n";
        $controllerContent .= "    {\n";
        $controllerContent .= "      \$this->{$name}Repository->delete{$name}(\$id);\n";
        $controllerContent .= "      Swal::toast('{$name} deleted successfully!', 'success')->timerProgressBar();\n";
        $controllerContent .= "      return redirect()->route('{$name}.index');\n";
        $controllerContent .= "    }\n";
        $controllerContent .= "}\n";

        file_put_contents($controllerPath, $controllerContent);
    }


    protected function modifyMigration()
    {
        $name = $this->argument('name');
        $name = Str::snake($name);
        $name = Str::plural($name);
        $migration = database_path('migrations/' . date('Y_m_d_His') . '_create_' . $name . '_table.php');

        $migrationContent = "<?php\n\n";
        $migrationContent .= "use Illuminate\Database\Migrations\Migration;\n";
        $migrationContent .= "use Illuminate\Database\Schema\Blueprint;\n";
        $migrationContent .= "use Illuminate\Support\Facades\Schema;\n\n";
        $migrationContent .= "return new class extends Migration\n";
        $migrationContent .= "{\n";
        $migrationContent .= "    /**\n";
        $migrationContent .= "     * Run the migrations.\n";
        $migrationContent .= "     */\n";
        $migrationContent .= "    public function up()\n";
        $migrationContent .= "    {\n";
        $migrationContent .= "        Schema::create('{$name}', function (Blueprint \$table) {\n";
        $migrationContent .= "            \$table->uuid('id')->primary();\n";
        $migrationContent .= "            // Add your columns here\n";
        $migrationContent .= "            \$table->softDeletes();\n";
        $migrationContent .= "            \$table->timestamps();\n";
        $migrationContent .= "        });\n";
        $migrationContent .= "    }\n\n";
        $migrationContent .= "    /**\n";
        $migrationContent .= "     * Reverse the migrations.\n";
        $migrationContent .= "     */\n";
        $migrationContent .= "    public function down()\n";
        $migrationContent .= "    {\n";
        $migrationContent .= "        Schema::dropIfExists('{$name}');\n";
        $migrationContent .= "    }\n";
        $migrationContent .= "};\n";

        file_put_contents($migration, $migrationContent);
    }

    protected function modifyRepository()
    {
        $name = $this->argument('name');
        $interfacePath = app_path("Interfaces/{$name}RepositoryInterface.php");
        $repositoryPath = app_path("Repositories/{$name}Repository.php");

        $interfaceContent = $this->generateInterfaceContent($name);

        $repositoryContent = $this->generateRepositoryContent($name);

        file_put_contents($interfacePath, $interfaceContent);
        file_put_contents($repositoryPath, $repositoryContent);

        $this->updateRepositoryServiceProvider($name);
    }

    protected function createTest()
    {
        $name = $this->argument('name') . 'Controller';
        $test = base_path("tests/Feature/{$name}Test.php");
        $testContent =
            <<<'EOT'
            <?php

            namespace Tests\Feature;

            use Illuminate\Support\Facades\Storage;
            use Tests\TestCase;

            class @name extends TestCase
            {
                public function setUp(): void
                {
                    parent::setUp();

                    Storage::fake('public');
                }

                //
            }
            EOT;
        $testContent = str_replace('@name', $name . 'Test', $testContent);

        file_put_contents($test, $testContent);
    }

    protected function createFactory()
    {
        $name = $this->argument('name');
        $factory = database_path("factories/{$name}Factory.php");

        $factoryContent = "<?php\n\n";
        $factoryContent .= "namespace Database\Factories;\n\n";
        $factoryContent .= "use Illuminate\Database\Eloquent\Factories\Factory;\n";
        $factoryContent .= "use Illuminate\Support\Str;\n\n";
        $factoryContent .= "class {$name}Factory extends Factory\n";
        $factoryContent .= "{\n";
        $factoryContent .= "    /**\n";
        $factoryContent .= "     * Define the model's default state.\n";
        $factoryContent .= "     *\n";
        $factoryContent .= "     * @return array<string, mixed>\n";
        $factoryContent .= "     */\n";
        $factoryContent .= "    public function definition(): array\n";
        $factoryContent .= "    {\n";
        $factoryContent .= "        return [\n";
        $factoryContent .= "            // Define your default state here\n";
        $factoryContent .= "        ];\n";
        $factoryContent .= "    }\n";
        $factoryContent .= "}\n";

        file_put_contents($factory, $factoryContent);
    }

    protected function createViews()
    {
        $name = $this->argument('name');
        $name = Str::kebab($name);

        $viewsPath = resource_path("views/pages/admin/{$name}");

        if (!file_exists($viewsPath)) {
            mkdir($viewsPath, 0755, true);
        }

        $indexViewPath = $viewsPath . '/index.blade.php';
        $indexViewContent = $this->generateIndexViewContent($name);
        file_put_contents($indexViewPath, $indexViewContent);

        $createViewPath = $viewsPath . '/create.blade.php';
        $createViewContent = $this->generateCreateViewContent($name);
        file_put_contents($createViewPath, $createViewContent);

        $editViewPath = $viewsPath . '/edit.blade.php';
        $editViewContent = $this->generateEditViewContent($name);
        file_put_contents($editViewPath, $editViewContent);

        $showViewPath = $viewsPath . '/show.blade.php';
        $showViewContent = $this->generateShowViewContent($name);
        file_put_contents($showViewPath, $showViewContent);
    }

    protected function generateInterfaceContent($name)
    {
        return "<?php\n\nnamespace App\Interfaces;\n\ninterface {$name}RepositoryInterface\n{\n" .
            "    public function getAll{$name}();\n" .
            "    public function get{$name}ById(string \$id);\n" .
            "    public function create{$name}(array \$data);\n" .
            "    public function update{$name}(array \$data, string \$id);\n" .
            "    public function delete{$name}(string \$id);\n}\n";
    }

    protected function generateRepositoryContent($name)
    {
        $pluralName = Str::plural($name);
        $varName = Str::lower($pluralName);

        $repositoryContent = "<?php\n\nnamespace App\Repositories;\n\nuse App\Interfaces\\{$name}RepositoryInterface;\n";
        $repositoryContent .= "use App\Models\\{$name};\n";
        $repositoryContent .= "use Illuminate\Support\Facades\DB;\n\n";
        $repositoryContent .= "class {$name}Repository implements {$name}RepositoryInterface\n{\n";
        $repositoryContent .= "    public function getAll{$name}()\n    {\n";
        $repositoryContent .= "        return {$name}::all();\n    }\n\n";
        $repositoryContent .= "    public function get{$name}ById(string \$id)\n    {\n";
        $repositoryContent .= "        return {$name}::findOrFail(\$id);\n    }\n\n";
        $repositoryContent .= "    public function create{$name}(array \$data)\n    {\n";
        $repositoryContent .= "        DB::beginTransaction();\n";
        $repositoryContent .= "        try {\n";
        $repositoryContent .= "           \${$varName} = {$name}::create(\$data);\n";
        $repositoryContent .= "            DB::commit();\n";
        $repositoryContent .= "            return \${$varName};\n";
        $repositoryContent .= "        } catch (\Exception \$e) {\n";
        $repositoryContent .= "            DB::rollBack();\n";
        $repositoryContent .= "            return \$e->getMessage();\n";
        $repositoryContent .= "        }\n    }\n\n";
        $repositoryContent .= "    public function update{$name}(array \$data, string \$id)\n    {\n";
        $repositoryContent .= "        DB::beginTransaction();\n";
        $repositoryContent .= "        try {\n";
        $repositoryContent .= "           \${$varName} = {$name}::findOrFail(\$id);\n";
        $repositoryContent .= "           \${$varName}->update(\$data);\n";
        $repositoryContent .= "            DB::commit();\n";
        $repositoryContent .= "            return \${$varName};\n";
        $repositoryContent .= "        } catch (\Exception \$e) {\n";
        $repositoryContent .= "            DB::rollBack();\n";
        $repositoryContent .= "            return \$e->getMessage();\n";
        $repositoryContent .= "        }\n    }\n\n";
        $repositoryContent .= "    public function delete{$name}(string \$id)\n    {\n";
        $repositoryContent .= "        DB::beginTransaction();\n";
        $repositoryContent .= "        try {\n";
        $repositoryContent .= "            {$name}::findOrFail(\$id)->delete();\n";
        $repositoryContent .= "            DB::commit();\n";
        $repositoryContent .= "            return true;\n";
        $repositoryContent .= "        } catch (\Exception \$e) {\n";
        $repositoryContent .= "            DB::rollBack();\n";
        $repositoryContent .= "            return \$e->getMessage();\n";
        $repositoryContent .= "        }\n    }\n}\n";

        return $repositoryContent;
    }

    protected function updateRepositoryServiceProvider($name)
    {
        $repositoryServiceProvider = app_path('Providers/RepositoryServiceProvider.php');
        $repositoryServiceProviderContent = file_get_contents($repositoryServiceProvider);

        $replacement = "\$this->app->bind(\App\Interfaces\\{$name}RepositoryInterface::class, \App\Repositories\\{$name}Repository::class);\n    }\n";

        $pattern = '/public function register\(\)\s*{([^}]*)}/s';
        $repositoryServiceProviderContent = preg_replace($pattern, "public function register() {\n$1$replacement", $repositoryServiceProviderContent, 1);

        file_put_contents($repositoryServiceProvider, $repositoryServiceProviderContent);
    }

    protected function generateIndexViewContent($name)
    {
        return "
<x-layouts.admin title=\"{$name}\">

    <x-ui.breadcumb-admin>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">{$name}</li>
    </x-ui.breadcumb-admin>

    <div class=\"row\">
        <div class=\"col-md-12 grid-margin stretch-card\">
            <x-ui.base-card>
                <x-slot name=\"header\">
                    <x-ui.base-button color=\"primary\" type=\"button\" href=\"{{ route('admin.{$name}.create') }}\">
                        Tambah {$name}
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name=\"thead\">
                        <tr>
                            <th>No</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name=\"tbody\">
                        @foreach (\${$name}s as \${$name})
                            <tr>
                                <td>{{ \$loop->iteration }}</td>
                                {{-- Add your columns here --}}
                                <td>
                                    <x-ui.base-button color=\"primary\" type=\"button\"
                                        href=\"{{ route('admin.{$name}.show', \${$name}->id) }}\">
                                        Detail
                                    </x-ui.base-button>

                                    <x-ui.base-button color=\"warning\" type=\"button\"
                                        href=\"{{ route('admin.{$name}.edit', \${$name}->id) }}\">
                                        Edit
                                    </x-ui.base-button>

                                    <form action=\"{{ route('admin.{$name}.destroy', \${$name}->id) }}\" method=\"POST\"
                                        class=\"d-inline\">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.base-button color=\"danger\" type=\"submit\" onclick=\"return confirm('Yakin ingin menghapus?')\">
                                            Hapus
                                        </x-ui.base-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>";

    }

    protected function generateCreateViewContent($name)
    {
        return "
<x-layouts.admin title=\"Tambah {$name}\">

    <x-ui.breadcumb-admin>
        <li class=\"breadcrumb-item\"><a href=\"{{ route('admin.{$name}.index') }}\">{$name}</a></li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">Tambah {$name}</li>
    </x-ui.breadcumb-admin>

    <div class=\"row\">
        <div class=\"col-md-12 grid-margin stretch-card\">
            <x-ui.base-card>
                <x-slot name=\"header\">
                    <h4 class=\"card-title\">Tambah {$name}</h4>
                </x-slot>
                <form action=\"{{ route('admin.{$name}.store') }}\" method=\"POST\">
                    @csrf
                  {{-- Add your form here --}}
                    <x-ui.base-button color=\"primary\" type=\"submit\">Simpan</x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>";
    }

    protected function generateEditViewContent($name)
    {
        return "
<x-layouts.admin title=\"Edit {$name}\">

    <x-ui.breadcumb-admin>
        <li class=\"breadcrumb-item\"><a href=\"{{ route('admin.{$name}.index') }}\">{$name}</a></li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">Edit {$name}</li>
    </x-ui.breadcumb-admin>

    <div class=\"row\">
        <div class=\"col-md-12 grid-margin stretch-card\">
            <x-ui.base-card>
                <x-slot name=\"header\">
                    <h4 class=\"card-title\">Edit {$name}</h4>
                </x-slot>
                <form action=\"{{ route('admin.{$name}.update', \${$name}->id) }}\" method=\"POST\">
                    @csrf
                    @method('PUT')
                    {{-- Add your form here --}}
                    <x-ui.base-button color=\"primary\" type=\"submit\">Simpan</x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>";
    }

    protected function generateShowViewContent($name)
    {
        return "
<x-layouts.admin title=\"Detail {$name}\">

    <x-ui.breadcumb-admin>
        <li class=\"breadcrumb-item\"><a href=\"{{ route('admin.{$name}.index') }}\">{$name}</a></li>
        <li class=\"breadcrumb-item active\" aria-current=\"page\">Detail {$name}</li>
    </x-ui.breadcumb-admin>

    <div class=\"row\">
        <div class=\"col-md-12 grid-margin stretch-card\">
            <x-ui.base-card>
                <x-slot name=\"header\">
                    <h4 class=\"card-title\">Detail {$name}</h4>
                </x-slot>
                {{-- Add your detail here --}}
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>";
    }

    protected function addRoutes()
    {
        $name = $this->argument('name');
        $name = Str::kebab($name);
        $routes = base_path('routes/admin.php');

        $routeContent = "\nRoute::resource('{$name}', App\Http\Controllers\Web\Admin\\{$name}Controller::class);";

        file_put_contents($routes, $routeContent, FILE_APPEND);
    }

    protected function addSidebarMenu()
    {
        $name = $this->argument('name');
        $name = Str::kebab($name);

        $sidebar = resource_path('views/components/ui/admin-sidebar.blade.php');

        $sidebarContent = "\n<li class=\"nav-item {{ request()->is('admin/{$name}') ? ' active' : '' }}\">\n";
        $sidebarContent .= "    <a href=\"{{ route('admin.{$name}.index') }}\" class=\"nav-link\">\n";
        $sidebarContent .= "        <i class=\"link-icon\" data-feather=\"list\"></i>\n";
        $sidebarContent .= "        <span class=\"link-title\">{$name}</span>\n";
        $sidebarContent .= "    </a>\n";
        $sidebarContent .= "</li>\n";


        file_put_contents($sidebar, $sidebarContent, FILE_APPEND);
    }
}
