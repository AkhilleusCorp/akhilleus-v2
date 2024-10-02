import {TypedUseSelectorHook, useSelector} from "react-redux";
import {RootState} from "../setup/redux";

export const useTypedSelector: TypedUseSelectorHook<RootState> = useSelector;