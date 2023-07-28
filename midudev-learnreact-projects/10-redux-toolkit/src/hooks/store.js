import { useDispatch, useSelector } from "react-redux";

//Externalizamos react-redux por si en un futuro queremos cambiar de libreria
export const useAppSelector = useSelector;
export const useAppDispatch = useDispatch;
