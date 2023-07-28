import { useDispatch } from "react-redux";
import { addNewUser, deleteUserById } from "../store/users/userSlice";

export const useUserActions = () => {
	const dispatch = useDispatch();

	const removeUser = (userID) => {
		dispatch(deleteUserById(userID));
	};
	const addUser = (user) => {
		dispatch(addNewUser(user));
	};

	return { removeUser, addUser };
};
