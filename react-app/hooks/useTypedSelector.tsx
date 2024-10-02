import {TypedUseSelectorHook, useSelector} from "react-redux";
import {RootState} from "../setup/redux/reducers";

export const useTypedSelector: TypedUseSelectorHook<RootState> = useSelector;