<?php

namespace App\Policies;

use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any transactions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1 || $user->role_id === 2;
    }

    /**
     * Determine whether the user can view the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        return $user->role_id === 1 || $user->id == $transaction->user->id; 
    }

    /**
     * Determine whether the user can create transactions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role_id === 2;
    }

    /**
     * Determine whether the user can update the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function update(User $user, Transaction $transaction)
    {
        return $user->role_id === 1;
        
    }

    /**
     * Determine whether the user can delete the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function delete(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can restore the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function restore(User $user, Transaction $transaction)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the transaction.
     *
     * @param  \App\User  $user
     * @param  \App\Transaction  $transaction
     * @return mixed
     */
    public function forceDelete(User $user, Transaction $transaction)
    {
        //
    }
}
