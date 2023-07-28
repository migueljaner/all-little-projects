import { createSlice } from "@reduxjs/toolkit";

const DEFOULT_STATE = [
	{
		id: "1",
		name: "Peter Jackson",
		email: "test@email.com",
		github: "migueljaner",
	},
	{
		id: "2",
		name: "Yumai Doe",
		email: "test@email.com",
		github: "yazmanito",
	},
	{
		id: "3",
		name: "Javi Doe",
		email: "test@email.com",
		github: "leo",
	},
	{
		id: "4",
		name: "Vicotoria Doe",
		email: "test@email.com",
		github: "leo",
	},
];

const initialState = (() => {
	const reduxState = localStorage.getItem("reduxState");
	if (reduxState) {
		return JSON.parse(reduxState).users;
	}
	return DEFOULT_STATE;
})();

export const usersSlice = createSlice({
	name: "users",
	initialState: initialState,
	reducers: {
		deleteUserById: (state, action) => {

			return state.filter((user) => user.id !== action.payload);
		},

		addNewUser: (state, action) => {
			const id = crypto.randomUUID();
			return [...state, { id, ...action.payload }];
		},
		rollbackUser: (state, action) => {
			const isUserInState = state.some((user) => user.id === action.payload.id);
			if (!isUserInState) {
				return [...state, action.payload];
			}
		},
	},
});

export default usersSlice.reducer;
export const { deleteUserById, addNewUser, rollbackUser } = usersSlice.actions;
