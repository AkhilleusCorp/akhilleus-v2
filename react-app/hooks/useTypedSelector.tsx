import {TypedUseSelectorHook, useSelector} from "react-redux";
import {RootState} from "../services/redux/reducers";

export const useTypedSelector: TypedUseSelectorHook<RootState> = useSelector;