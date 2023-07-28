import { configureStore } from "@reduxjs/toolkit";
import { toast } from "sonner";
import usersReducer, { rollbackUser } from "./users/userSlice";

const persistanceLocalStorageMiddleware = (store) => (next) => (action) => {
	next(action);
	localStorage.setItem("reduxState", JSON.stringify(store.getState()));
};

const syncWithDatabaseMiddleware = (store) => (next) => (action) => {
	const { type, payload } = action;
	const prevState = store.getState();

	next(action);

	if (type === "users/deleteUserById") {
		const userToRemove = prevState.users.find((user) => user.id === payload);

		fetch(`https://jsonplaceholder.typicode.com/users/${payload}`, {
			method: "DELETE",
		})
			.then((res) => {
				if (!res.ok) throw new Error("Error deleting user");
				toast.success(` User ${payload} deleted`);
			})
			.catch((err) => {
				toast.error(`Error deleting user ${payload}`);
				if (userToRemove) store.dispatch(rollbackUser(userToRemove));
			});
	}
};

export const store = configureStore({
	reducer: {
		users: usersReducer,
	},
	middleware: [persistanceLocalStorageMiddleware, syncWithDatabaseMiddleware],
});
