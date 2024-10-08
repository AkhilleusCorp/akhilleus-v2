import {applyMiddleware, createStore} from "redux";
import reducers from "./reducers";
import {thunk} from "redux-thunk";


/**
 * TODO: Migrate to configureStore from react toolkit
 */
export const store= createStore(reducers, {}, applyMiddleware(thunk));