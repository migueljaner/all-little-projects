import "./App.css";
import { ListOfUsers } from "./components/ListOfUsers";

import { Provider } from "react-redux";
import { Toaster } from "sonner";
import { CreateNewUser } from "./components/CreateNewUser";
import { store } from "./store";

function App() {
	return (
		<Provider store={store}>
			<ListOfUsers />
			<CreateNewUser />
			<Toaster richColors />
		</Provider>
	);
}

export default App;
