<?php
/*****************Question 1 **********************/

User::query()
->where('status', 'active')
->orderByDesc('created_at')
->get();

/*****************Question 2 **********************/
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
/* Used the existing 'auth' middleware of Laravel */
/* I used this for simplicity and to avoid to make it from scratch since Laravel had this alreaady. */

/*****************Question 3 **********************/

//Interface for client repository
interface ClientRepositoryInterface
{
    public function create(array $data): Client;
}

//The client repository itself
class ClientRepository implements ClientRepositoryInterface
{
	public function create(array $data): ?Client
	{
		return Client::create($data);
	}
}

//Form Validation Class for storing of client
namespace App\Http\Requests\Client;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientDetailsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'required|max:255',
			'email' => 'required|email|unique:clients',
			'status' => 'required|in:active,inactive',
        ];
    }
}

//Main
use App\Http\Requests\StoreClientDetailsRequest;
use App\Repository\ClientRepository;

class ClientDetailController 
{
	public function storeClientDetails(StoreClientDetailsRequest $request, ClientRepository $repository) : JsonResponse
	{
		try {

			$client = $this->repository->create($request->validated());
		
			return response()->json(['status' => 'success', 'client' => $client]);
		} catch (ValidationException $validationException) {
			return response()->json(['status' => 'error', 'message' => $validationException->errors()]);
		} catch (\Exception $exception) {
			return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
		}
	
	}
}

